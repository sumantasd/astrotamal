<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('short_description')
                    ->required(),
                Textarea::make('full_description')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('icon')
                    ->required()
                    ->default('sparkles'),
                FileUpload::make('image')
                    ->image(),
                TextInput::make('badge'),
                TextInput::make('price'),
                TextInput::make('duration')
                    ->required()
                    ->default('45 Mins'),
                Toggle::make('is_featured')
                    ->required(),
                TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
