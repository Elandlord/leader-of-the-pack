<?php

namespace App\Filament\Resources\Reviews\Schemas;

use App\Filament\Resources\Dogs\DogResource;
use App\Models\Review;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ReviewInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                TextEntry::make('id')
                    ->label('ID'),
                TextEntry::make('author')
                    ->label('Auteur'),
                TextEntry::make('rating')
                    ->label('Beoordeling'),
                TextEntry::make('text')
                    ->label('Reviewtekst')
                    ->placeholder('—'),
                TextEntry::make('location')
                    ->label('Locatie')
                    ->placeholder('—'),
                TextEntry::make('type')
                    ->label('Beoordeling voor')
                    ->placeholder('—'),
                TextEntry::make('dog.name')
                    ->label('Hond')
                    ->url(fn (Review $record) => $record->dog ? DogResource::getUrl('view', ['record' => $record->dog]) : null)
                    ->placeholder('—'),
            ]);
    }
}
