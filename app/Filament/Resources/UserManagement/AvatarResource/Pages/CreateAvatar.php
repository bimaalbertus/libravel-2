<?php

namespace App\Filament\Resources\UserManagement\AvatarResource\Pages;

use App\Filament\Resources\UserManagement\AvatarResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAvatar extends CreateRecord
{
    protected static string $resource = AvatarResource::class;
}
