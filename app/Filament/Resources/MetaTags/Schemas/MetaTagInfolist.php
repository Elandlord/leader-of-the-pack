<?php

namespace App\Filament\Resources\MetaTags\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class MetaTagInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                TextEntry::make('id')
                    ->label('ID'),
                TextEntry::make('metaTaggable.name')
                    ->label('Meta tag voor:'),
                TextEntry::make('name')
                    ->label('Naam'),
                TextEntry::make('content')
                    ->label('Content')
                    ->placeholder('—'),
            ]);
    }
}
