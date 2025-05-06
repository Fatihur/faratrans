<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CarResource\Pages;
use App\Filament\Resources\CarResource\RelationManagers;
use App\Models\Car;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CarResource extends Resource
{
    protected static ?string $model = Car::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('brand')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('type')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('category')
                    ->options([
                        'sedan' => 'Sedan',
                        'suv' => 'SUV',
                        'mpv' => 'MPV',
                        'hatchback' => 'Hatchback',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('passenger_capacity')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('self_drive_price')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('with_driver_price')
                    ->required()
                    ->numeric(),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->directory('cars'),
                Forms\Components\Textarea::make('description'),
                Forms\Components\Textarea::make('specifications'),
                Forms\Components\Toggle::make('is_featured'),
                Forms\Components\Toggle::make('is_available'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('brand'),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('category'),
                Tables\Columns\TextColumn::make('passenger_capacity'),
                Tables\Columns\TextColumn::make('self_drive_price')
                    ->money('idr'),
                Tables\Columns\TextColumn::make('with_driver_price')
                    ->money('idr'),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
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
            'index' => Pages\ListCars::route('/'),
            'create' => Pages\CreateCar::route('/create'),
            'edit' => Pages\EditCar::route('/{record}/edit'),
        ];
    }
}
