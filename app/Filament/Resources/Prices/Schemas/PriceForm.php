<?php

namespace App\Filament\Resources\Prices\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PriceForm
{
    public const TYPES = [
        'Local Walks' => 'Wandeling (in Beetsterzwaag incl. ophalen)',
        'Travel Walks' => 'Wandeling (buiten Beetsterzwaag)',
        'Daycare' => 'Oppas',
    ];

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                TextInput::make('name')
                    ->label('Pakketnaam')
                    ->helperText('Vul hier de naam van het pakket in, bijvoorbeeld: 1 hond, losse wandeling.')
                    ->required(),
                Textarea::make('description')
                    ->label('Beschrijving')
                    ->helperText('Vul hier de beschrijving in, bijvoorbeeld: 10 uren naar wens te besteden. 2 honden van hetzelfde adres. 4 maanden geldig.')
                    ->nullable(),
                TextInput::make('costs')
                    ->label('Kosten')
                    ->helperText('Vul hier het totaalbedrag in van het pakket.')
                    ->numeric()
                    ->step(0.01)
                    ->prefix('€')
                    ->required(),
                Select::make('type')
                    ->label('Type')
                    ->options(self::TYPES)
                    ->helperText('Selecteer hier het tarieftype')
                    ->required(),
            ]);
    }
}
