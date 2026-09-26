<?php

namespace App\Filament\Resources\HoroscopeForecasts\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class HoroscopeForecastForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('horoscope_id')
                    ->relationship('horoscope', 'zodiac_sign')
                    ->required(),
                Select::make('period_type')
                    ->options([
                        'daily' => 'Daily',
                        'weekly' => 'Weekly',
                        'monthly' => 'Monthly',
                        'yearly' => 'Yearly',
                    ])
                    ->required(),
                DatePicker::make('period_start'),
                DatePicker::make('period_end'),
                TextInput::make('title')
                    ->required(),
                Textarea::make('summary')
                    ->columnSpanFull(),
                Textarea::make('overview')
                    ->columnSpanFull(),
                Textarea::make('career')
                    ->columnSpanFull(),
                Textarea::make('finance')
                    ->columnSpanFull(),
                Textarea::make('love')
                    ->columnSpanFull(),
                Textarea::make('health')
                    ->columnSpanFull(),
                Textarea::make('education')
                    ->columnSpanFull(),
                Textarea::make('family')
                    ->columnSpanFull(),
                Textarea::make('travel')
                    ->columnSpanFull(),
                Textarea::make('important_dates')
                    ->columnSpanFull(),
                Textarea::make('advice')
                    ->columnSpanFull(),
                TextInput::make('lucky_day'),
                TextInput::make('lucky_colour'),
                TextInput::make('lucky_number'),
                Textarea::make('planetary_influence')
                    ->columnSpanFull(),
                Textarea::make('transit_context')
                    ->columnSpanFull(),
                Select::make('status')
                    ->options([
                        'published' => 'Published',
                        'draft' => 'Draft',
                    ])
                    ->default('published')
                    ->required(),
                Toggle::make('featured'),
                TextInput::make('seo_title'),
                Textarea::make('seo_description')
                    ->columnSpanFull(),
                DateTimePicker::make('published_at'),
            ]);
    }
}
