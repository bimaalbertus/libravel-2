<?php

namespace App\Filament\Resources\Admin\CollectionResource\Pages;

use App\Filament\Resources\Admin\CollectionResource;
use App\Models\Collection;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewCollection extends ViewRecord
{
    protected static string $resource = CollectionResource::class;

    public function getTitle(): string | Htmlable
    {
        /** @var Collection */
        $record = $this->getRecord();

        return $record->title;
    }

    protected function getActions(): array
    {
        return [];
    }
}
