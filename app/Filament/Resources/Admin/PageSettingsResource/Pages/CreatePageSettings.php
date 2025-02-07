<?php

namespace App\Filament\Resources\Admin\PageSettingsResource\Pages;

use App\Filament\Resources\Admin\PageSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePageSettings extends CreateRecord
{
    protected static string $resource = PageSettingsResource::class;
}
