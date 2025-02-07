<?php

namespace App\Filament\Resources\Admin\BannerResource\Pages;

use App\Filament\Resources\Admin\BannerResource;
use App\Models\Banner;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewBanner extends ViewRecord
{
    protected static string $resource = BannerResource::class;

    public function getTitle(): string | Htmlable
    {
        /** @var Banner */
        $record = $this->getRecord();

        return $record->title;
    }

    protected function getActions(): array
    {
        return [];
    }
}
