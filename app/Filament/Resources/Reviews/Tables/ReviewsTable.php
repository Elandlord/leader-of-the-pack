<?php

namespace App\Filament\Resources\Reviews\Tables;

use App\Filament\Resources\Dogs\DogResource;
use App\Models\Review;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ReviewsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                TextColumn::make('author')
                    ->label('Auteur'),
                TextColumn::make('rating')
                    ->label('Beoordeling'),
                TextColumn::make('location')
                    ->label('Locatie'),
                TextColumn::make('type')
                    ->label('Beoordeling voor'),
                TextColumn::make('dog.name')
                    ->label('Hond')
                    ->url(fn (Review $record) => $record->dog ? DogResource::getUrl('view', ['record' => $record->dog]) : null),
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
