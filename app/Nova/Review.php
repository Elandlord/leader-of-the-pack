<?php

namespace App\Nova;

use App\Models\Review as ReviewModel;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Review extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = ReviewModel::class;

    /**
     * @inheritDoc
     */
    public static function label(): string
    {
        return 'Beoordelingen';
    }

    /**
     * @inheritDoc
     */
    public static function singularLabel(): string
    {
        return 'Beoordeling';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'author';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'author',
        'rating',
        'text',
        'location',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        $possibleRatings = collect(range(1, 5))->mapWithKeys(function($item, $key) {
            return [$item => $item];
        })->toArray();

        return [
            ID::make(__('ID'), 'id')->sortable(),
            Text::make('Auteur', 'author')
                ->help('Vul hier de naam in van de auteur van de review.')
                ->required()
                ->rules('required'),
            Select::make('Beoordeling', 'rating')
                ->options($possibleRatings)
                ->displayUsingLabels()
                ->required()
                ->rules('required'),
            Textarea::make('Reviewtekst', 'text')
                ->help('Vul hier de reviewtekst in die de auteur heeft opgegeven.'),
            Text::make('Locatie', 'location')
                ->help('Vul hier (optioneel) de locatie waar de hond uitgelaten is, of de woonplaats van de auteur.'),
            Text::make('Beoordeling voor', 'type')
                ->help('Vul hier waarvoor deze review geschreven is (wandeling, oppas, training of iets anders).'),
            BelongsTo::make('Hond', 'dog', Dog::class)
                ->help('Selecteer hier (optioneel) de bijhorende hond.')
                ->nullable()
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
