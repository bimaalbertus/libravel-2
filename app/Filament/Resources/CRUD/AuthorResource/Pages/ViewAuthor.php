<?php

namespace App\Filament\Resources\CRUD\AuthorResource\Pages;

use App\Filament\Resources\CRUD\AuthorResource;
use App\Models\Author;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewAuthor extends ViewRecord
{
    protected static string $resource = AuthorResource::class;

    public function getTitle(): string | Htmlable
    {
        /** @var Author */
        $record = $this->getRecord();

        return $record->fullname;
    }

    protected function getActions(): array
    {
        return [];
    }
}
