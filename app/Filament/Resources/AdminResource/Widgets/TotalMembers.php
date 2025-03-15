<?php

namespace App\Filament\Resources\AdminResource\Widgets;

use App\Models\User;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class TotalMembers extends ChartWidget
{
    protected static ?string $heading = 'Total Users';

    protected static ?string $pollingInterval = '10s';

    protected function getData(): array
    {
        $monthlyMembers = [];
        $labels = [];

        $currentYear = Carbon::now()->year;

        for ($month = 1; $month <= 12; $month++) {
            $startDate = Carbon::create($currentYear, $month, 1, 0, 0, 0);
            $endDate = $startDate->copy()->endOfMonth();

            $count = User::whereBetween('created_at', [$startDate, $endDate])->count();

            $monthlyMembers[] = $count;
            $labels[] = $startDate->format('M');
        }

        return [
            'datasets' => [
                [
                    'label' => 'Users',
                    'data' => $monthlyMembers,
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
