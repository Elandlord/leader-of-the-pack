<?php

namespace App\Filament\Resources\Reasons\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ReasonForm
{
    public const ICONS = [
        'schedule' => 'Klokje',
        'favorite' => 'Hartje',
        'psychology_alt' => 'Vraagteken',
        'pets' => 'Hondenpootje',
    ];

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                TextInput::make('why')
                    ->label('Pijnpunt (reden)')
                    ->helperText('Vul hier het pijnpunt in, of de reden waarom men jouw moet inhuren.')
                    ->required(),
                Select::make('icon')
                    ->label('Icoontje')
                    ->options(self::ICONS)
                    ->required(),
                Textarea::make('solution')
                    ->label('Oplossing')
                    ->helperText('Vul welke oplossing jij biedt voor het pijnpunt.'),
            ]);
    }
}
