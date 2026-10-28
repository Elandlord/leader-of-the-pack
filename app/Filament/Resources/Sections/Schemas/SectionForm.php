<?php

namespace App\Filament\Resources\Sections\Schemas;

use App\Models\Page;
use Filament\Actions\Action;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MorphToSelect;
use Filament\Forms\Components\MorphToSelect\Type;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Livewire\Component;

class SectionForm
{
    public const BLOCK_LABELS = [
        'title' => 'Titel',
        'text_block' => 'Tekst blok',
        'button' => 'Knop',
        'image' => 'Foto',
    ];

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                MorphToSelect::make('sectionable')
                    ->label('Sectionable')
                    ->types([
                        Type::make(Page::class)
                            ->label('Pagina')
                            ->titleAttribute('name'),
                    ])
                    ->disabled()
                    ->hidden(fn (Component $livewire) => $livewire instanceof RelationManager),
                Builder::make('content')
                    ->label('Content')
                    ->blocks([
                        Block::make('title')
                            ->label(self::BLOCK_LABELS['title'])
                            ->schema([
                                TextInput::make('title')
                                    ->label('Titel'),
                            ]),
                        Block::make('text_block')
                            ->label(self::BLOCK_LABELS['text_block'])
                            ->schema([
                                Textarea::make('text_block')
                                    ->label('Tekstblok'),
                            ]),
                        Block::make('button')
                            ->label(self::BLOCK_LABELS['button'])
                            ->schema([
                                TextInput::make('button')
                                    ->label('Tekst in knop'),
                                TextInput::make('url')
                                    ->label('URL naar pagina'),
                            ]),
                        Block::make('image')
                            ->label(self::BLOCK_LABELS['image'])
                            ->schema([
                                FileUpload::make('image')
                                    ->label('Afbeelding')
                                    ->disk('public'),
                                TextInput::make('alt')
                                    ->label('Alternatieve tekst')
                                    ->helperText('Deze tekst wordt getoond als de afbeelding niet ingeladen kan worden. Beschrijf wat er te zien is op de fotos.'),
                            ]),
                    ])
                    ->addActionLabel('Voeg content blok toe')
                    ->deleteAction(fn (Action $action) => $action->requiresConfirmation())
                    ->helperText('Vul dit veld met content. Dit wordt vervolgens weergegeven op de website.'),
            ]);
    }
}
