<?php

namespace App\Filament\Resources\Reasons\Pages;

use App\Filament\Resources\Reasons\ReasonResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewReason extends ViewRecord
{
    protected static string $resource = ReasonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
