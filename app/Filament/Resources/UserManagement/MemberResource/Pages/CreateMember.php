<?php

namespace App\Filament\Resources\UserManagement\MemberResource\Pages;

use App\Filament\Resources\UserManagement\MemberResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMember extends CreateRecord
{
    protected static string $resource = MemberResource::class;
}
