<?php

namespace App\Nova;

use App\Models\Reason as ReasonModel;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;

class Reason extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = ReasonModel::class;

    /**
     * @inheritDoc
     */
    public static function singularLabel(): string
    {
        return 'Pijnpunt';
    }

    /**
     * @inheritDoc
     */
    public static function label()
    {
        return 'Pijnpunten';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'why';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'why',
        'solution',
        'icon',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        $possbileIcons = collect([
            'schedule' => 'Klokje',
            'favorite' => 'Hartje',
            'psychology_alt' => 'Vraagteken',
            'pets' => 'Hondenpootje',
        ]);

        return [
            ID::make(__('ID'), 'id')->sortable(),
            Text::make('Pijnpunt (reden)', 'why')
                ->help('Vul hier het pijnpunt in, of de reden waarom men jouw moet inhuren.')
                ->required()
                ->rules('required'),
            Select::make('Icoontje', 'icon')
                ->options($possbileIcons)
                ->displayUsingLabels()
                ->required()
                ->rules('required'),
            Textarea::make('Oplossing', 'solution')
                ->help('Vul welke oplossing jij biedt voor het pijnpunt.'),
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
