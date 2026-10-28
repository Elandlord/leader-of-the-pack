<?php

namespace App\Filament\Resources\Sections\Schemas;

use Filament\Infolists\Components\KeyValueEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SectionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                TextEntry::make('id')
                    ->label('ID'),
                TextEntry::make('sectionable.name')
                    ->label('Sectionable'),
                TextEntry::make('flexible_title')
                    ->label('Titel')
                    ->placeholder('—'),
                TextEntry::make('flexible_text_block')
                    ->label('Beschrijving')
                    ->placeholder('—'),
                RepeatableEntry::make('content')
                    ->label('Content')
                    ->schema([
                        TextEntry::make('type')
                            ->hiddenLabel()
                            ->formatStateUsing(fn (string $state) => SectionForm::BLOCK_LABELS[$state] ?? $state),
                        KeyValueEntry::make('data')
                            ->hiddenLabel(),
                    ])
                    ->placeholder('—'),
            ]);
    }
}
