<?php

namespace App\Filament\Resources\CRUD\MajorResource\Pages;

use App\Filament\Resources\CRUD\MajorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMajors extends ListRecords
{
    protected static string $resource = MajorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
