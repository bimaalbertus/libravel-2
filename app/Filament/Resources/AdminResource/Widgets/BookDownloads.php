<?php

namespace App\Filament\Resources\AdminResource\Widgets;

use App\Models\Download;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class BookDownloads extends ChartWidget
{
    protected static ?string $heading = 'Downloads';

    protected static ?string $pollingInterval = '10s';

    protected function getData(): array
    {
        $monthlyDownloads = [];
        $labels = [];

        $currentYear = Carbon::now()->year;

        for ($month = 1; $month <= 12; $month++) {
            $startDate = Carbon::create($currentYear, $month, 1, 0, 0, 0);
            $endDate = $startDate->copy()->endOfMonth();

            $count = Download::whereBetween('downloaded_at', [$startDate, $endDate])->count();

            $monthlyDownloads[] = $count;
            $labels[] = $startDate->format('M');
        }

        return [
            'datasets' => [
                [
                    'label' => 'Downloads',
                    'data' => $monthlyDownloads,
                    'fill' => 'start',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
