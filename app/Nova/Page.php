<?php

namespace App\Nova;

use App\Nova\Traits\HasDownloadFields;
use App\Nova\Traits\HasLinkFields;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphMany;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;

class Page extends Resource
{
    use HasDownloadFields;
    use HasLinkFields;

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Informatie op website';

    public static function singularLabel()
    {
        return 'Pagina';
    }

    public static function label()
    {
        return "Pagina's";
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\Page';

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
        'id', 'name', 'title',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        $resourceId = (int) $request->resourceId ?? null;

        $optionalFields = [];

        // Page 1 = homepage
        if (in_array($resourceId, [1])) {
            $optionalFields[] = new Panel('Bannerfoto', $this->bannerPhotoFields());
        }

        // Page 6 = aanmelden, Page 7 = Afmelden
        if (in_array($resourceId, [6, 7])) {
            $optionalFields[] = new Panel('Links', $this->linkFields());
            $optionalFields[] = new Panel('Documenten', $this->downloadFields());
        }

        return array_merge([
            ID::make()->sortable(),
            Text::make('Naam', 'name')
                ->readonly()
                ->nullable()
                ->help('Vul hier de naam in van de pagina.')
                ->sortable()
                ->hideWhenUpdating(),
            Text::make('Paginatitel', 'title')
                ->nullable()
                ->help('Dit is de titel die in Google getoond wordt voor deze pagina.'),
            Text::make('Route naam', 'route_name')
                ->nullable()
                ->readonly()
                ->hideFromIndex()
                ->hideWhenUpdating()
                ->help('Dit is de naam die gebruikt wordt door het systeem om de pagina te achterhalen. Gelieve dit veld niet aan te passen.'),
            Boolean::make('Weergeven in zoekresultaat', 'show_in_search_results')
                ->readonly()
                ->help('Wil je dat deze pagina gevonden kan worden via de zoekfunctie van de website?'),
            MorphMany::make('Secties', 'sections', 'App\Nova\Section'),
            MorphMany::make('Meta tags', 'metaTags', 'App\Nova\MetaTag'),
        ], $optionalFields);
    }

    public function bannerPhotoFields(): array
    {
        return [
            Images::make('Bannerfoto (desktop groot)', 'banner_photo_desktop_large')
                ->mustCrop()
                ->croppingConfigs(['ratio' => 16 / 10]),
            Images::make('Bannerfoto (desktop)', 'banner_photo_desktop')
                ->mustCrop()
                ->croppingConfigs(['ratio' => 16 / 10]),
            Images::make('Bannerfoto (tablet)', 'banner_photo_tablet')
                ->mustCrop()
                ->croppingConfigs(['ratio' => 209 / 224]),
            Images::make('Bannerfoto (mobiel)', 'banner_photo_mobile')
                ->mustCrop()
                ->croppingConfigs(['ratio' => 1255 / 1839]),
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
