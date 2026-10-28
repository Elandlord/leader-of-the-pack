<?php

namespace App\Filament\Resources\Pages\RelationManagers;

use App\Filament\Resources\Sections\SectionResource;
use App\Filament\Resources\Sections\Schemas\SectionForm;
use App\Filament\Resources\Sections\Schemas\SectionInfolist;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class SectionsRelationManager extends RelationManager
{
    protected static string $relationship = 'sections';

    protected static ?string $title = 'Secties';

    public function form(Schema $schema): Schema
    {
        return SectionForm::configure($schema);
    }

    public function infolist(Schema $schema): Schema
    {
        return SectionInfolist::configure($schema);
    }

    public function table(Table $table): Table
    {
        return SectionResource::table($table)
            ->paginated([5])
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
