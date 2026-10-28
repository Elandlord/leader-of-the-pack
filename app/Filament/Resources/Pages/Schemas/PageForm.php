<?php

namespace App\Filament\Resources\Pages\Schemas;

use App\Models\Page;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PageForm
{
    public const HOMEPAGE_ID = 1;

    public const PAGES_WITH_LINKS_AND_DOCUMENTS = [6, 7];

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                TextInput::make('name')
                    ->label('Naam')
                    ->disabled()
                    ->nullable()
                    ->helperText('Vul hier de naam in van de pagina.')
                    ->hiddenOn('edit'),
                TextInput::make('title')
                    ->label('Paginatitel')
                    ->nullable()
                    ->helperText('Dit is de titel die in Google getoond wordt voor deze pagina.'),
                TextInput::make('route_name')
                    ->label('Route naam')
                    ->nullable()
                    ->disabled()
                    ->hiddenOn('edit')
                    ->helperText('Dit is de naam die gebruikt wordt door het systeem om de pagina te achterhalen. Gelieve dit veld niet aan te passen.'),
                Checkbox::make('show_in_search_results')
                    ->label('Weergeven in zoekresultaat')
                    ->disabled()
                    ->helperText('Wil je dat deze pagina gevonden kan worden via de zoekfunctie van de website?'),
                Section::make('Bannerfoto')
                    ->schema(self::bannerPhotoFields())
                    ->visible(fn (?Page $record) => $record?->getKey() === self::HOMEPAGE_ID),
                Section::make('Links')
                    ->schema(self::linkFields())
                    ->visible(fn (?Page $record) => self::hasLinksAndDocuments($record)),
                Section::make('Documenten')
                    ->schema(self::downloadFields())
                    ->visible(fn (?Page $record) => self::hasLinksAndDocuments($record)),
            ]);
    }

    public static function hasLinksAndDocuments(?Page $record): bool
    {
        return in_array($record?->getKey(), self::PAGES_WITH_LINKS_AND_DOCUMENTS, true);
    }

    private static function bannerPhotoFields(): array
    {
        return [
            self::bannerPhoto('banner_photo_desktop_large', 'Bannerfoto (desktop groot)', '16:10'),
            self::bannerPhoto('banner_photo_desktop', 'Bannerfoto (desktop)', '16:10'),
            self::bannerPhoto('banner_photo_tablet', 'Bannerfoto (tablet)', '209:224'),
            self::bannerPhoto('banner_photo_mobile', 'Bannerfoto (mobiel)', '1255:1839'),
        ];
    }

    private static function bannerPhoto(string $collection, string $label, string $aspectRatio): SpatieMediaLibraryFileUpload
    {
        return SpatieMediaLibraryFileUpload::make($collection)
            ->label($label)
            ->collection($collection)
            ->disk(config('media-library.disk_name'))
            ->image()
            ->imageEditor()
            ->imageEditorAspectRatioOptions([$aspectRatio])
            ->imageAspectRatio($aspectRatio)
            ->automaticallyOpenImageEditorForAspectRatio();
    }

    private static function linkFields(): array
    {
        return [
            Builder::make('links')
                ->label('Links')
                ->blocks([
                    Block::make('link')
                        ->label('Link')
                        ->schema([
                            TextInput::make('text')
                                ->label('Getoonde tekst'),
                            TextInput::make('link')
                                ->label('Link naar referentie'),
                        ]),
                ])
                ->addActionLabel('Voeg link toe')
                ->nullable()
                ->helperText('Vul hier de links in van het onderwerp. Deze links moeten wel in het veld hierboven geactiveerd worden om opgenomen te worden op de pagina.'),
        ];
    }

    private static function downloadFields(): array
    {
        return [
            SpatieMediaLibraryFileUpload::make('supporting_files')
                ->label('Documenten')
                ->collection('supporting_files')
                ->disk(config('media-library.disk_name'))
                ->multiple()
                ->reorderable()
                ->downloadable()
                ->helperText('Upload hier eventuele documenten voor deze pagina.'),
        ];
    }
}
