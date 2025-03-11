<?php

namespace App\Filament\Resources\UserManagement\MemberResource\Pages;

use App\Filament\Resources\CRUD\MemberResource;
use App\Models\User;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewMember extends ViewRecord
{
    protected static string $resource = MemberResource::class;

    public function getTitle(): string | Htmlable
    {
        /** @var User */
        $record = $this->getRecord();

        return $record->username;
    }

    protected function getActions(): array
    {
        return [];
    }
}
