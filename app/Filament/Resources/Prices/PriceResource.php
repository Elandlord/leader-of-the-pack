<?php

namespace App\Filament\Resources\Prices;

use App\Filament\Resources\Prices\Pages\CreatePrice;
use App\Filament\Resources\Prices\Pages\EditPrice;
use App\Filament\Resources\Prices\Pages\ListPrices;
use App\Filament\Resources\Prices\Pages\ViewPrice;
use App\Filament\Resources\Prices\Schemas\PriceForm;
use App\Filament\Resources\Prices\Schemas\PriceInfolist;
use App\Filament\Resources\Prices\Tables\PricesTable;
use App\Models\Price;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PriceResource extends Resource
{
    private const SEARCH_COLUMNS = ['name', 'description', 'costs'];

    protected static ?string $model = Price::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $modelLabel = 'Tarief';

    protected static ?string $pluralModelLabel = 'Tarieven';

    protected static ?string $recordTitleAttribute = 'name';

    public static function getGloballySearchableAttributes(): array
    {
        return self::SEARCH_COLUMNS;
    }

    public static function form(Schema $schema): Schema
    {
        return PriceForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PriceInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PricesTable::configure($table)->searchable(self::SEARCH_COLUMNS);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPrices::route('/'),
            'create' => CreatePrice::route('/create'),
            'view' => ViewPrice::route('/{record}'),
            'edit' => EditPrice::route('/{record}/edit'),
        ];
    }
}
