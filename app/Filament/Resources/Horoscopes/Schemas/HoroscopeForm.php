<?php

namespace App\Filament\Resources\Horoscopes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class HoroscopeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('zodiac_sign')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('symbol')
                    ->required(),
                TextInput::make('element')
                    ->required(),
                TextInput::make('date_range')
                    ->required(),
                TextInput::make('ruling_planet')
                    ->required(),
                TextInput::make('lucky_number')
                    ->required(),
                TextInput::make('lucky_color')
                    ->required(),
                Textarea::make('overview')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('daily_prediction')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('weekly_prediction')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('monthly_prediction')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
