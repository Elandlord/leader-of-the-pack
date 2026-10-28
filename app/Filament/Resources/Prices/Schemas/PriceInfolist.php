<?php

namespace App\Filament\Resources\Prices\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PriceInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                TextEntry::make('id')
                    ->label('ID'),
                TextEntry::make('name')
                    ->label('Pakketnaam'),
                TextEntry::make('description')
                    ->label('Beschrijving')
                    ->placeholder('—'),
                TextEntry::make('costs')
                    ->label('Kosten')
                    ->money('EUR'),
                TextEntry::make('type')
                    ->label('Type')
                    ->formatStateUsing(fn (?string $state) => PriceForm::TYPES[$state] ?? $state)
                    ->placeholder('—'),
            ]);
    }
}
