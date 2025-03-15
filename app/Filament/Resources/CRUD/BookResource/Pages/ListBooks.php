<?php

namespace App\Filament\Resources\CRUD\BookResource\Pages;

use App\Filament\Resources\CRUD\BookResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Hydrat\TableLayoutToggle\Concerns\HasToggleableTable;
use App\Filament\Resources\CRUD\BookResource\Widgets\BookOverview;

class ListBooks extends ListRecords
{
    protected static string $resource = BookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            BookOverview::class,
        ];
    }
}
