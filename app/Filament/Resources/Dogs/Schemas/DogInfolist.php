<?php

namespace App\Filament\Resources\Dogs\Schemas;

use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class DogInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                TextEntry::make('id')
                    ->label('ID'),
                TextEntry::make('name')
                    ->label('Naam van de hond'),
                TextEntry::make('description')
                    ->label('Beschrijving')
                    ->placeholder('—'),
                TextEntry::make('breed')
                    ->label('Ras')
                    ->placeholder('—'),
                TextEntry::make('birthyear')
                    ->label('Geboortejaar')
                    ->placeholder('—'),
                SpatieMediaLibraryImageEntry::make('dog_photo')
                    ->label('Foto van hond')
                    ->collection('dog_photo')
                    ->placeholder('—'),
            ]);
    }
}
