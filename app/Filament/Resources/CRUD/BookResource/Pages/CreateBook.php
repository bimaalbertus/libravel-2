<?php

namespace App\Filament\Resources\CRUD\BookResource\Pages;

use App\Filament\Resources\CRUD\BookResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBook extends CreateRecord
{
    protected static string $resource = BookResource::class;
}
