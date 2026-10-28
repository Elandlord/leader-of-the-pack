<?php

namespace App\Filament\Resources\MetaTags\Schemas;

use App\Models\Page;
use Filament\Forms\Components\MorphToSelect;
use Filament\Forms\Components\MorphToSelect\Type;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;
use Livewire\Component;

class MetaTagForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                MorphToSelect::make('metaTaggable')
                    ->label('Meta tag voor:')
                    ->types([
                        Type::make(Page::class)
                            ->label('Pagina')
                            ->titleAttribute('name'),
                    ])
                    ->required()
                    ->hidden(fn (Component $livewire) => $livewire instanceof RelationManager),
                TextInput::make('name')
                    ->label('Naam')
                    ->markAsRequired()
                    ->helperText(new HtmlString('Vul hier de naam in van de meta tag (bijv: keywords). Voor uitleg zie: <a target="_blank" href="https://www.w3schools.com/tags/tag_meta.asp">W3schools</a>')),
                Textarea::make('content')
                    ->label('Content')
                    ->markAsRequired()
                    ->helperText(new HtmlString('Vul hier de content in van de meta tag (bijv: nakijken, scriptie, editor, student). Voor uitleg zie: <a target="_blank" href="https://www.w3schools.com/tags/tag_meta.asp">W3schools</a>')),
            ]);
    }
}
