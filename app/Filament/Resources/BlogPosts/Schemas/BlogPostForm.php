<?php

namespace App\Filament\Resources\BlogPosts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BlogPostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('category')
                    ->required(),
                Textarea::make('summary')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('content')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->image(),
                TextInput::make('author_name')
                    ->required()
                    ->default('Tamal Chakraborty'),
                TextInput::make('read_time')
                    ->required()
                    ->default('5 min read'),
                DateTimePicker::make('published_at'),
                Toggle::make('is_featured')
                    ->required(),
            ]);
    }
}
