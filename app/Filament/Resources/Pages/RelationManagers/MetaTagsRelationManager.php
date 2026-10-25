<?php

namespace App\Filament\Resources\Pages\RelationManagers;

use App\Filament\Resources\MetaTags\MetaTagResource;
use App\Filament\Resources\MetaTags\Schemas\MetaTagForm;
use App\Filament\Resources\MetaTags\Schemas\MetaTagInfolist;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class MetaTagsRelationManager extends RelationManager
{
    protected static string $relationship = 'metaTags';

    protected static ?string $title = 'Meta tags';

    public function form(Schema $schema): Schema
    {
        return MetaTagForm::configure($schema);
    }

    public function infolist(Schema $schema): Schema
    {
        return MetaTagInfolist::configure($schema);
    }

    public function table(Table $table): Table
    {
        return MetaTagResource::table($table)
            ->paginated([5])
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
