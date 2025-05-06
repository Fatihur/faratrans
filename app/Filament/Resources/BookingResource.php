<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Filament\Resources\BookingResource\RelationManagers;
use App\Models\Booking;
use App\Models\Car;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $modelLabel = 'Pemesanan';

    protected static ?string $navigationLabel = 'Pemesanan';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Penyewa')
                    ->schema([
                        Forms\Components\TextInput::make('customer_name')
                            ->label('Nama Penyewa')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('customer_phone')
                            ->label('Nomor WhatsApp')
                            ->required()
                            ->tel()
                            ->maxLength(20),

                        Forms\Components\Textarea::make('customer_address')
                            ->label('Alamat')
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Detail Penyewaan')
                    ->schema([
                        Forms\Components\Select::make('car_id')
                            ->label('Mobil')
                            ->options(Car::all()->pluck('full_name', 'id'))
                            ->searchable()
                            ->required()
                            ->live()
                            ->afterStateUpdated(function ($state, Forms\Set $set) {
                                $car = Car::find($state);
                                if ($car) {
                                    $set('total_price', $car->self_drive_price);
                                }
                            }),

                        Forms\Components\Select::make('rent_type')
                            ->label('Tipe Sewa')
                            ->options([
                                'self_drive' => 'Lepas Kunci',
                                'with_driver' => 'Dengan Driver',
                            ])
                            ->required()
                            ->live()
                            ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                                $car = Car::find($get('car_id'));
                                if ($car) {
                                    $set('total_price', $state === 'with_driver'
                                        ? $car->with_driver_price
                                        : $car->self_drive_price);
                                }
                            }),

                        Forms\Components\TextInput::make('total_price')
                            ->label('Total Harga')
                            ->numeric()
                            ->prefix('Rp')
                            ->required(),

                        Forms\Components\DateTimePicker::make('start_date')
                            ->label('Tanggal/Jam Sewa')
                            ->required()
                            ->native(false)
                            ->minutesStep(30),

                        Forms\Components\DateTimePicker::make('end_date')
                            ->label('Tanggal/Jam Kembali')
                            ->required()
                            ->native(false)
                            ->minutesStep(30)
                            ->minDate(fn(Forms\Get $get) => $get('start_date')),

                        Forms\Components\Toggle::make('returned')
                            ->label('Sudah Dikembalikan')
                            ->inline(false),

                        Forms\Components\Textarea::make('notes')
                            ->label('Catatan')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Nama')
                    ->searchable(),

                Tables\Columns\TextColumn::make('car.full_name')
                    ->label('Mobil')
                    ->searchable(),

                Tables\Columns\TextColumn::make('rent_type')
                    ->label('Tipe Sewa')
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'self_drive' => 'Lepas Kunci',
                        'with_driver' => 'Dengan Driver',
                    })
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'self_drive' => 'info',
                        'with_driver' => 'success',
                    }),

                Tables\Columns\TextColumn::make('total_price')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('start_date')
                    ->label('Sewa')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('end_date')
                    ->label('Kembali')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

                Tables\Columns\IconColumn::make('returned')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->trueColor('success')
                    ->falseIcon('heroicon-o-x-circle')
                    ->falseColor('danger'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('rent_type')
                    ->label('Tipe Sewa')
                    ->options([
                        'self_drive' => 'Lepas Kunci',
                        'with_driver' => 'Dengan Driver',
                    ]),

                Tables\Filters\Filter::make('returned')
                    ->label('Sudah Dikembalikan')
                    ->query(fn(Builder $query): Builder => $query->where('returned', true)),

                Tables\Filters\Filter::make('not_returned')
                    ->label('Belum Dikembalikan')
                    ->query(fn(Builder $query): Builder => $query->where('returned', false)),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('mark_returned')
                    ->label('Tandai Dikembalikan')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->hidden(fn(Booking $record) => $record->returned)
                    ->action(function (Booking $record) {
                        $record->update(['returned' => true]);
                    }),
                Tables\Actions\Action::make('send_reminder')
                    ->label('Kirim Reminder')
                    ->icon('heroicon-o-chat-bubble-left-ellipsis')
                    ->color('warning')
                    ->action(function (Booking $record) {
                        $message = "Halo {$record->customer_name},\n\n";
                        $message .= "Ini adalah reminder untuk pengembalian mobil:\n";
                        $message .= "Mobil: {$record->car->full_name}\n";
                        $message .= "Harus dikembalikan pada: {$record->end_date->format('d M Y H:i')}\n\n";
                        $message .= "Terima kasih.";

                        $waLink = "https://wa.me/{$record->customer_phone}?text=" . urlencode($message);

                        return redirect()->away($waLink);
                    }),
                    Tables\Actions\Action::make('pdf')
                    ->label('PDF')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('gray')
                    ->action(function (Booking $record) {
                        $pdf = Pdf::loadView('exports.booking-pdf', ['booking' => $record]);
                        
                        return response()->streamDownload(
                            fn () => print($pdf->output()),
                            'booking-' . $record->id . '.pdf'
                        );
                    }),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('start_date', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
