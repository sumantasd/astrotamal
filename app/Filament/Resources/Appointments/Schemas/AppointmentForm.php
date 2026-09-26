<?php

namespace App\Filament\Resources\Appointments\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class AppointmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('phone')
                    ->tel()
                    ->required(),
                DatePicker::make('birth_date'),
                TimePicker::make('birth_time'),
                TextInput::make('birth_place'),
                Select::make('service_id')
                    ->relationship('service', 'title'),
                DatePicker::make('preferred_date')
                    ->required(),
                TextInput::make('preferred_time')
                    ->required(),
                Textarea::make('notes')
                    ->columnSpanFull(),
                TextInput::make('status')
                    ->required()
                    ->default('Pending'),
            ]);
    }
}
