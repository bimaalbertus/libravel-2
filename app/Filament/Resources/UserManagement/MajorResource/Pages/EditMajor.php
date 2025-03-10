<?php

namespace App\Filament\Resources\UserManagement\MajorResource\Pages;

use App\Filament\Resources\UserManagement\MajorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMajor extends EditRecord
{
    protected static string $resource = MajorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
