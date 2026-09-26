<?php

namespace App\Filament\Resources\HoroscopeForecasts\Pages;

use App\Filament\Resources\HoroscopeForecasts\HoroscopeForecastResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditHoroscopeForecast extends EditRecord
{
    protected static string $resource = HoroscopeForecastResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
