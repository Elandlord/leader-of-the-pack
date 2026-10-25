<?php

namespace App\Filament\Resources\Prices\Tables;

use App\Filament\Resources\Prices\Schemas\PriceForm;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PricesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Pakketnaam'),
                TextColumn::make('costs')
                    ->label('Kosten')
                    ->money('EUR'),
                TextColumn::make('type')
                    ->label('Type')
                    ->formatStateUsing(fn (?string $state) => PriceForm::TYPES[$state] ?? $state),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
