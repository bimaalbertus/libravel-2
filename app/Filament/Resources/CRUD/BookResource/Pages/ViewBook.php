<?php

namespace App\Filament\Resources\CRUD\BookResource\Pages;

use App\Filament\Resources\CRUD\BookResource;
use App\Models\Book;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewBook extends ViewRecord
{
    protected static string $resource = BookResource::class;

    public function getTitle(): string | Htmlable
    {
        /** @var Book */
        $record = $this->getRecord();

        return $record->title;
    }

    protected function getActions(): array
    {
        return [];
    }
}
