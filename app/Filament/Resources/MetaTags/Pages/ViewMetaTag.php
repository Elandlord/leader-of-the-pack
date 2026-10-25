<?php

namespace App\Filament\Resources\MetaTags\Pages;

use App\Filament\Resources\MetaTags\MetaTagResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewMetaTag extends ViewRecord
{
    protected static string $resource = MetaTagResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
