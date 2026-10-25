<?php

namespace App\Filament\Resources\Reviews\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ReviewForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                TextInput::make('author')
                    ->label('Auteur')
                    ->helperText('Vul hier de naam in van de auteur van de review.')
                    ->required(),
                Select::make('rating')
                    ->label('Beoordeling')
                    ->options(array_combine(range(1, 5), range(1, 5)))
                    ->required(),
                Textarea::make('text')
                    ->label('Reviewtekst')
                    ->helperText('Vul hier de reviewtekst in die de auteur heeft opgegeven.'),
                TextInput::make('location')
                    ->label('Locatie')
                    ->helperText('Vul hier (optioneel) de locatie waar de hond uitgelaten is, of de woonplaats van de auteur.'),
                TextInput::make('type')
                    ->label('Beoordeling voor')
                    ->helperText('Vul hier waarvoor deze review geschreven is (wandeling, oppas, training of iets anders).'),
                Select::make('dog_id')
                    ->label('Hond')
                    ->relationship('dog', 'name')
                    ->helperText('Selecteer hier (optioneel) de bijhorende hond.')
                    ->nullable(),
            ]);
    }
}
