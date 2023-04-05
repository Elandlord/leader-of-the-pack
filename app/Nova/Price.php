<?php

namespace App\Nova;

use App\Models\Price as PriceModel;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Price extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = PriceModel::class;

    /**
     * @inheritDoc
     */
    public static function singularLabel(): string
    {
        return 'Tarief';
    }

    /**
     * @inheritDoc
     */
    public static function label(): string
    {
        return 'Tarieven';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
        'description',
        'costs',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Text::make('Pakketnaam', 'name')
                ->help('Vul hier de naam van het pakket in, bijvoorbeeld: 1 hond, losse wandeling.')
                ->required()
                ->rules('required'),
            Textarea::make('Beschrijving', 'description')
                ->help('Vul hier de beschrijving in, bijvoorbeeld: 10 uren naar wens te besteden. 2 honden van hetzelfde adres. 4 maanden geldig.')
                ->nullable(),
            Currency::make('Kosten', 'costs')
                ->help('Vul hier het totaalbedrag in van het pakket.')
                ->required()
                ->rules('required'),
            Select::make('Type', 'type')
                ->options([
                    'Walks' => 'Wandeling',
                    'Daycare' => 'Oppas'
                ])
                ->displayUsingLabels()
                ->help('Selecteer hier het tarieftype')
                ->required()
                ->rules('required')
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
