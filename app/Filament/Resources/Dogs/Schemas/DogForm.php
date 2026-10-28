<?php

namespace App\Filament\Resources\Dogs\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                TextInput::make('name')
                    ->label('Naam van de hond')
                    ->required(),
                Textarea::make('description')
                    ->label('Beschrijving')
                    ->helperText('Vul hier de beschrijving in van de hond. Hoe is zijn/haar uiterlijk, gedrag andere kenmerken. Wat is leuk voor de websitebezoeker om te lezen.')
                    ->nullable()
                    ->markAsRequired(),
                TextInput::make('breed')
                    ->label('Ras')
                    ->nullable(),
                Select::make('birthyear')
                    ->label('Geboortejaar')
                    ->helperText('Selecteer het geboortejaar. Indien niet bekend, laat het veld dan leeg.')
                    ->options(fn () => self::birthYearOptions())
                    ->nullable(),
                SpatieMediaLibraryFileUpload::make('dog_photo')
                    ->label('Foto van hond')
                    ->collection('dog_photo')
                    ->disk(config('media-library.disk_name'))
                    ->image(),
            ]);
    }

    public static function birthYearOptions(): array
    {
        $currentYear = (int) now()->format('Y');
        $years = array_reverse(range($currentYear - 30, $currentYear));

        return array_combine($years, $years);
    }
}
