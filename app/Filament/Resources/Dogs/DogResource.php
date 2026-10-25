<?php

namespace App\Filament\Resources\Dogs;

use App\Filament\Resources\Dogs\Pages\CreateDog;
use App\Filament\Resources\Dogs\Pages\EditDog;
use App\Filament\Resources\Dogs\Pages\ListDogs;
use App\Filament\Resources\Dogs\Pages\ViewDog;
use App\Filament\Resources\Dogs\Schemas\DogForm;
use App\Filament\Resources\Dogs\Schemas\DogInfolist;
use App\Filament\Resources\Dogs\Tables\DogsTable;
use App\Models\Dog;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DogResource extends Resource
{
    private const SEARCH_COLUMNS = ['name', 'description', 'breed'];

    protected static ?string $model = Dog::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $modelLabel = 'Hond';

    protected static ?string $pluralModelLabel = 'Honden';

    protected static ?string $recordTitleAttribute = 'name';

    public static function getGloballySearchableAttributes(): array
    {
        return self::SEARCH_COLUMNS;
    }

    public static function form(Schema $schema): Schema
    {
        return DogForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DogInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DogsTable::configure($table)->searchable(self::SEARCH_COLUMNS);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDogs::route('/'),
            'create' => CreateDog::route('/create'),
            'view' => ViewDog::route('/{record}'),
            'edit' => EditDog::route('/{record}/edit'),
        ];
    }
}
