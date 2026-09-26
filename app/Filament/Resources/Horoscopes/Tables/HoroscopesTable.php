<?php

namespace App\Filament\Resources\Horoscopes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class HoroscopesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('zodiac_sign')
                    ->searchable(),
                TextColumn::make('slug')
                    ->searchable(),
                TextColumn::make('symbol')
                    ->searchable(),
                TextColumn::make('element')
                    ->searchable(),
                TextColumn::make('date_range')
                    ->searchable(),
                TextColumn::make('ruling_planet')
                    ->searchable(),
                TextColumn::make('lucky_number')
                    ->searchable(),
                TextColumn::make('lucky_color')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
