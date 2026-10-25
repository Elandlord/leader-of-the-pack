<?php

namespace App\Filament\Resources\Pages\Schemas;

use App\Models\Page;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\KeyValueEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PageInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                TextEntry::make('id')
                    ->label('ID'),
                TextEntry::make('name')
                    ->label('Naam')
                    ->placeholder('—'),
                TextEntry::make('title')
                    ->label('Paginatitel')
                    ->placeholder('—'),
                TextEntry::make('route_name')
                    ->label('Route naam')
                    ->placeholder('—'),
                IconEntry::make('show_in_search_results')
                    ->label('Weergeven in zoekresultaat')
                    ->boolean(),
                Section::make('Bannerfoto')
                    ->schema([
                        self::bannerPhoto('banner_photo_desktop_large', 'Bannerfoto (desktop groot)'),
                        self::bannerPhoto('banner_photo_desktop', 'Bannerfoto (desktop)'),
                        self::bannerPhoto('banner_photo_tablet', 'Bannerfoto (tablet)'),
                        self::bannerPhoto('banner_photo_mobile', 'Bannerfoto (mobiel)'),
                    ])
                    ->visible(fn (Page $record) => $record->getKey() === PageForm::HOMEPAGE_ID),
                Section::make('Links')
                    ->schema([
                        RepeatableEntry::make('links')
                            ->label('Links')
                            ->schema([
                                KeyValueEntry::make('data')
                                    ->hiddenLabel(),
                            ])
                            ->placeholder('—'),
                    ])
                    ->visible(fn (Page $record) => PageForm::hasLinksAndDocuments($record)),
                Section::make('Documenten')
                    ->schema([
                        TextEntry::make('supporting_files_list')
                            ->label('Documenten')
                            ->state(fn (Page $record) => $record->getMedia('supporting_files')
                                ->map(fn ($media) => $media->getCustomProperty('file_name') ?: $media->file_name)
                                ->all())
                            ->listWithLineBreaks()
                            ->placeholder('—'),
                    ])
                    ->visible(fn (Page $record) => PageForm::hasLinksAndDocuments($record)),
            ]);
    }

    private static function bannerPhoto(string $collection, string $label): SpatieMediaLibraryImageEntry
    {
        return SpatieMediaLibraryImageEntry::make($collection)
            ->label($label)
            ->collection($collection)
            ->placeholder('—');
    }
}
