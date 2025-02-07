<?php

namespace App\Filament\Resources\Admin\PageSettingsResource\Pages;

use App\Filament\Resources\Admin\PageSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPageSettings extends EditRecord
{
    protected static string $resource = PageSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
