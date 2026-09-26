<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('client_name')
                    ->required(),
                TextInput::make('city')
                    ->required(),
                TextInput::make('avatar'),
                TextInput::make('rating')
                    ->required()
                    ->numeric()
                    ->default(5),
                TextInput::make('service_tag'),
                Textarea::make('review')
                    ->required()
                    ->columnSpanFull(),
                Toggle::make('is_approved')
                    ->required(),
            ]);
    }
}
