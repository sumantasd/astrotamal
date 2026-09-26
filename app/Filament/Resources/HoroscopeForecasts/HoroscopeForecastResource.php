<?php

namespace App\Filament\Resources\HoroscopeForecasts;

use App\Filament\Resources\HoroscopeForecasts\Pages\CreateHoroscopeForecast;
use App\Filament\Resources\HoroscopeForecasts\Pages\EditHoroscopeForecast;
use App\Filament\Resources\HoroscopeForecasts\Pages\ListHoroscopeForecasts;
use App\Filament\Resources\HoroscopeForecasts\Schemas\HoroscopeForecastForm;
use App\Filament\Resources\HoroscopeForecasts\Tables\HoroscopeForecastsTable;
use App\Models\HoroscopeForecast;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class HoroscopeForecastResource extends Resource
{
    protected static ?string $model = HoroscopeForecast::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSparkles;
    protected static \UnitEnum|string|null $navigationGroup = 'Astrology Management';

    public static function form(Schema $schema): Schema
    {
        return HoroscopeForecastForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HoroscopeForecastsTable::configure($table);
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
            'index' => ListHoroscopeForecasts::route('/'),
            'create' => CreateHoroscopeForecast::route('/create'),
            'edit' => EditHoroscopeForecast::route('/{record}/edit'),
        ];
    }
}
