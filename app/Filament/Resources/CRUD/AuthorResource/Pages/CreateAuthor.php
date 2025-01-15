<?php

namespace App\Filament\Resources\CRUD\AuthorResource\Pages;

use App\Filament\Resources\CRUD\AuthorResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAuthor extends CreateRecord
{
    protected static string $resource = AuthorResource::class;
}
