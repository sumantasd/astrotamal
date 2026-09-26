<?php

namespace App\Filament\Resources\Horoscopes\Pages;

use App\Filament\Resources\Horoscopes\HoroscopeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHoroscopes extends ListRecords
{
    protected static string $resource = HoroscopeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
