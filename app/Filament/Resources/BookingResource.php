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
use Carbon\Carbon;

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
                            ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                                self::updateTotalPrice($set, $get);
                            }),

                        Forms\Components\Select::make('rent_type')
                            ->label('Tipe Sewa')
                            ->options([
                                'self_drive' => 'Lepas Kunci',
                                'with_driver' => 'All In',
                            ])
                            ->required()
                            ->live()
                            ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                                self::updateTotalPrice($set, $get);
                            }),

                        Forms\Components\TextInput::make('total_price')
                            ->label('Total Harga')
                            ->numeric()
                            ->prefix('Rp')
                            ->required()
                            ->readOnly()
                            ->dehydrated(),

                        Forms\Components\DateTimePicker::make('start_date')
                            ->label('Tanggal/Jam Sewa')
                            ->required()
                            ->native(false)
                            ->minutesStep(30)
                            ->live()
                            ->afterStateUpdated(function (Forms\Set $set, Forms\Get $get) {
                                $set('end_date', null);
                                self::updateTotalPrice($set, $get);
                            }),

                        Forms\Components\DateTimePicker::make('end_date')
                            ->label('Tanggal/Jam Kembali')
                            ->required()
                            ->native(false)
                            ->minutesStep(30)
                            ->minDate(fn(Forms\Get $get) => $get('start_date'))
                            ->live()
                            ->afterStateUpdated(function (Forms\Set $set, Forms\Get $get) {
                                self::updateTotalPrice($set, $get);
                            }),

                        Forms\Components\Toggle::make('returned')
                            ->label('Sudah Dikembalikan')
                            ->inline(false),

                        Forms\Components\Textarea::make('notes')
                            ->label('Catatan')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    protected static function updateTotalPrice(Forms\Set $set, Forms\Get $get): void
    {
        $carId = $get('car_id');
        $rentType = $get('rent_type');
        $startDate = $get('start_date');
        $endDate = $get('end_date');
    
        if (!$carId || !$rentType || !$startDate || !$endDate) {
            $set('total_price', 0);
            return;
        }
    
        $car = Car::find($carId);
        if (!$car) {
            $set('total_price', 0);
            return;
        }
    
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);
        
        // Hitung perbedaan hari (minimum 1 hari)
        $days = $start->diffInDays($end);
        $days = max($days, 1); // Minimum 1 hari
    
        // Get daily rate based on rental type
        $dailyRate = ($rentType === 'with_driver') 
            ? $car->with_driver_price 
            : $car->self_drive_price;
    
        // Calculate total price
        $totalPrice = $days * $dailyRate;
    
        $set('total_price', $totalPrice);
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
                        'with_driver' => 'All In',
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
                        'with_driver' => 'All In',
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
                        $customer = preg_replace('/[^A-Za-z0-9]/', '_', $record->customer_name);
                        $mobil = preg_replace('/[^A-Za-z0-9]/', '_', $record->car->brand . '_' . $record->car->type);
                        $tanggal = $record->start_date->format('Ymd');
                        $filename = $customer . '_' . $mobil . '_' . $tanggal . '.pdf';
                        return response()->streamDownload(
                            fn () => print($pdf->output()),
                            $filename
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