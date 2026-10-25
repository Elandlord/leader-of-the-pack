<?php

namespace App\Filament\Resources\Reasons\Tables;

use App\Filament\Resources\Reasons\Schemas\ReasonForm;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ReasonsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                TextColumn::make('why')
                    ->label('Pijnpunt (reden)'),
                TextColumn::make('icon')
                    ->label('Icoontje')
                    ->formatStateUsing(fn (?string $state) => ReasonForm::ICONS[$state] ?? $state),
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
