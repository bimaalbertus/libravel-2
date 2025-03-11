<?php

namespace App\Filament\Resources\UserManagement\AvatarResource\Pages;

use App\Filament\Resources\UserManagement\AvatarResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAvatar extends EditRecord
{
    protected static string $resource = AvatarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
