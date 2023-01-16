<?php

namespace App\Nova\Traits;

use Ebess\AdvancedNovaMediaLibrary\Fields\Files;
use Laravel\Nova\Fields\Text;

trait HasDownloadFields
{
    public function downloadFields(): array
    {
        return [
            Files::make('Documenten', 'supporting_files')
                ->customPropertiesFields([
                    Text::make('Bestandsnaam', 'file_name'),
                ])
                ->help('Upload hier eventuele documenten voor deze pagina.'),
        ];
    }
}
