<?php

namespace App\Filament\Resources\Admin\CollectionResource\Pages;

use App\Filament\Resources\Admin\CollectionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCollection extends CreateRecord
{
    protected static string $resource = CollectionResource::class;
}
