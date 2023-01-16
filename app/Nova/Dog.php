<?php

namespace App\Nova;

use App\Models\Dog as DogModel;
use Carbon\Carbon;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Dog extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = DogModel::class;

    /**
     * @inheritDoc
     */
    public static function singularLabel(): string
    {
        return 'Hond';
    }

    /**
     * @inheritDoc
     */
    public static function label(): string
    {
        return 'Honden';
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
        'breed'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        $currentYear = (int) now()->format('Y');

        $possibleBirthYears = range($currentYear - 30, $currentYear);
        $possibleBirthYears[] = '';
        $possibleBirthYears = collect(array_reverse($possibleBirthYears))
            ->mapWithKeys(fn($item, $key) => [$item => $item]);
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Text::make('Naam van de hond', 'name')
                ->rules('required')
                ->required(),
            Textarea::make('Beschrijving', 'description')
                ->help('Vul hier de beschrijving in van de hond. Hoe is zijn/haar uiterlijk, gedrag andere kenmerken. Wat is leuk voor de websitebezoeker om te lezen.')
                ->nullable()
                ->required(),
            Text::make('Ras', 'breed')
                ->nullable(),
            Select::make('Geboortejaar', 'birthyear')
                ->nullable()
                ->help('Selecteer het geboortejaar. Indien niet bekend, laat het veld dan leeg.')
                ->displayUsingLabels()
                ->options($possibleBirthYears),
            Images::make('Foto van hond', 'dog_photo')
                ->conversionOnIndexView('thumb')
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
