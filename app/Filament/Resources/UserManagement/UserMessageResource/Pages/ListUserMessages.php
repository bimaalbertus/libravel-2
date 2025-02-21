<?php

namespace App\Filament\Resources\UserManagement\UserMessageResource\Pages;

use App\Filament\Resources\UserManagement\UserMessageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUserMessages extends ListRecords
{
    protected static string $resource = UserMessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
