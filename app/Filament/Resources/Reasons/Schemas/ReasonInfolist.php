<?php

namespace App\Filament\Resources\Reasons\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ReasonInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                TextEntry::make('id')
                    ->label('ID'),
                TextEntry::make('why')
                    ->label('Pijnpunt (reden)'),
                TextEntry::make('icon')
                    ->label('Icoontje')
                    ->formatStateUsing(fn (?string $state) => ReasonForm::ICONS[$state] ?? $state),
                TextEntry::make('solution')
                    ->label('Oplossing')
                    ->placeholder('—'),
            ]);
    }
}
