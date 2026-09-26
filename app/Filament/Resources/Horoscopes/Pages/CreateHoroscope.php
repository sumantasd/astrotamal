<?php

namespace App\Filament\Resources\Horoscopes\Pages;

use App\Filament\Resources\Horoscopes\HoroscopeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateHoroscope extends CreateRecord
{
    protected static string $resource = HoroscopeResource::class;
}
