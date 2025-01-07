<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Widgets;

use App\Filament\Resources\AdminResource\Widgets\LatestBooks;
use App\Filament\Resources\AdminResource\Widgets\StatsWidget;
use App\Filament\Resources\AdminResource\Widgets\TotalMembers;
use App\Filament\Resources\AdminResource\Widgets\BookDownloads;

class Dashboard extends BaseDashboard
{

    public function getWidgets(): array
    {
        return [
            Widgets\AccountWidget::class,
            Widgets\FilamentInfoWidget::class,
            StatsWidget::class,
            BookDownloads::class,
            TotalMembers::class,
            LatestBooks::class
        ];
    }
}
