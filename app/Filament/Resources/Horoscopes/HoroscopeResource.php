<?php

namespace App\Filament\Resources\Horoscopes;

use App\Filament\Resources\Horoscopes\Pages\CreateHoroscope;
use App\Filament\Resources\Horoscopes\Pages\EditHoroscope;
use App\Filament\Resources\Horoscopes\Pages\ListHoroscopes;
use App\Filament\Resources\Horoscopes\Schemas\HoroscopeForm;
use App\Filament\Resources\Horoscopes\Tables\HoroscopesTable;
use App\Models\Horoscope;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class HoroscopeResource extends Resource
{
    protected static ?string $model = Horoscope::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return HoroscopeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HoroscopesTable::configure($table);
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
            'index' => ListHoroscopes::route('/'),
            'create' => CreateHoroscope::route('/create'),
            'edit' => EditHoroscope::route('/{record}/edit'),
        ];
    }
}
