<?php

namespace App\Nova\Traits;

use Laravel\Nova\Fields\Text;
use Whitecube\NovaFlexibleContent\Flexible;

trait HasLinkFields
{
    public function linkFields(): array
    {
        return [
            Flexible::make('Links', 'links')
                ->addLayout('Link', 'link', [
                    Text::make('Getoonde tekst', 'text'),
                    Text::make('Link naar referentie', 'link'),
                ])
                ->button('Voeg link toe')
                ->nullable()
                ->help('Vul hier de links in van het onderwerp. Deze links moeten wel in het veld hierboven geactiveerd worden om opgenomen te worden op de pagina.'),
        ];
    }
}
