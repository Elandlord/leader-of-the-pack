<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Whitecube\NovaFlexibleContent\Flexible;

class Section extends Resource
{
    public static function singularLabel()
    {
        return 'Sectie';
    }

    public static function label()
    {
        return 'Secties';
    }

    public static $displayInNavigation = false;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\Section';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'flexible_title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'content',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            MorphTo::make('Sectionable')->types([
                Page::class,
            ])->readonly(),
            Text::make('Titel', 'flexible_title')->exceptOnForms(),
            Text::make('Beschrijving', 'flexible_text_block')->exceptOnForms(),
            Flexible::make('Content', 'content')->confirmRemove()
                ->addLayout('Titel', 'title', [
                    Text::make('Titel', 'title')->showOnIndex(),
                ])->showOnIndex()
                ->addLayout('Tekst blok', 'text_block', [
                    Textarea::make('Tekstblok', 'text_block'),
                ])
                ->addLayout('Knop', 'button', [
                    Text::make('Tekst in knop', 'button'),
                    Text::make('URL naar pagina', 'url'),
                ])
                ->addLayout('Foto', 'image', [
                    File::make('Afbeelding', 'image'),
                    Text::make('Alternatieve tekst', 'alt')
                        ->help('Deze tekst wordt getoond als de afbeelding niet ingeladen kan worden. Beschrijf wat er te zien is op de fotos.'),
                ])->nullable()
                ->hideFromIndex()
                ->button('Voeg content blok toe')
                ->help('Vul dit veld met content. Dit wordt vervolgens weergegeven op de website.'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
