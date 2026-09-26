<?php

namespace App\Filament\Resources\Horoscopes\Pages;

use App\Filament\Resources\Horoscopes\HoroscopeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditHoroscope extends EditRecord
{
    protected static string $resource = HoroscopeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
