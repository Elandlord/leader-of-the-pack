<?php

namespace App\Filament\Resources\Reasons;

use App\Filament\Resources\Reasons\Pages\CreateReason;
use App\Filament\Resources\Reasons\Pages\EditReason;
use App\Filament\Resources\Reasons\Pages\ListReasons;
use App\Filament\Resources\Reasons\Pages\ViewReason;
use App\Filament\Resources\Reasons\Schemas\ReasonForm;
use App\Filament\Resources\Reasons\Schemas\ReasonInfolist;
use App\Filament\Resources\Reasons\Tables\ReasonsTable;
use App\Models\Reason;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ReasonResource extends Resource
{
    private const SEARCH_COLUMNS = ['why', 'solution', 'icon'];

    protected static ?string $model = Reason::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $modelLabel = 'Pijnpunt';

    protected static ?string $pluralModelLabel = 'Pijnpunten';

    protected static ?string $recordTitleAttribute = 'why';

    public static function getGloballySearchableAttributes(): array
    {
        return self::SEARCH_COLUMNS;
    }

    public static function form(Schema $schema): Schema
    {
        return ReasonForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ReasonInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ReasonsTable::configure($table)->searchable(self::SEARCH_COLUMNS);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListReasons::route('/'),
            'create' => CreateReason::route('/create'),
            'view' => ViewReason::route('/{record}'),
            'edit' => EditReason::route('/{record}/edit'),
        ];
    }
}
