<?php

namespace App\Filament\Resources\UserManagement\UserMessageResource\Pages;

use App\Filament\Resources\UserManagement\UserMessageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUserMessage extends CreateRecord
{
    protected static string $resource = UserMessageResource::class;
}
