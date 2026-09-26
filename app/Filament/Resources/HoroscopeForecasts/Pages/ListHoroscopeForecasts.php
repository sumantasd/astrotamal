<?php

namespace App\Filament\Resources\HoroscopeForecasts\Pages;

use App\Filament\Resources\HoroscopeForecasts\HoroscopeForecastResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHoroscopeForecasts extends ListRecords
{
    protected static string $resource = HoroscopeForecastResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
