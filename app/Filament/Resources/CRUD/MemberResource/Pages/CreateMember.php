<?php

namespace App\Filament\Resources\CRUD\MemberResource\Pages;

use App\Filament\Resources\CRUD\MemberResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMember extends CreateRecord
{
    protected static string $resource = MemberResource::class;
}
