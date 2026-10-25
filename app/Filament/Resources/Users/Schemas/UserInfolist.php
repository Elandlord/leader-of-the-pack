<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Filament\Resources\Users\UserResource;
use App\Models\User;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                TextEntry::make('id')
                    ->label('ID'),
                ImageEntry::make('avatar')
                    ->label('Avatar')
                    ->state(fn (User $record) => UserResource::gravatarUrl($record))
                    ->imageSize(50),
                TextEntry::make('name')
                    ->label('Name'),
                TextEntry::make('email')
                    ->label('Email'),
            ]);
    }
}
