<?php

namespace App\Filament\Resources\AdminResource\Widgets;

use App\Models\Member;
use App\Models\Book;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class StatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return array_merge(
            MemberStats::getCards(),
            BookStats::getCards()
        );
    }
}

class MemberStats
{
    public static function getCards(): array
    {
        $newMembersThisWeek = Member::where('created_at', '>=', now()->subDays(7))->count();
        $newMembersLastWeek = Member::whereBetween('created_at', [
            now()->subWeek()->startOfWeek(),
            now()->subWeek()->endOfWeek(),
        ])->count();
        $membersChange = $newMembersLastWeek > 0
            ? round(($newMembersThisWeek - $newMembersLastWeek) * 100)
            : 0;

        $membersChart = Trend::model(Member::class)
            ->between(
                start: now()->subWeeks(4),
                end: now()
            )
            ->perWeek()
            ->count()
            ->map(fn(TrendValue $value) => $value->aggregate)
            ->toArray();

        return [
            Stat::make('New Members This Week', $newMembersThisWeek)
                ->description($membersChange >= 0 ? "Active Grow" : "No Grow")
                ->descriptionIcon($membersChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->chart(
                    $membersChart
                )
                ->color($membersChange >= 0 ? 'success' : 'danger'),
        ];
    }
}

class BookStats
{
    public static function getCards(): array
    {
        $newBooksThisWeek = Book::where('created_at', '>=', now()->subDays(7))->count();
        $newBooksLastWeek = Book::whereBetween('created_at', [
            now()->subWeek()->startOfWeek(),
            now()->subWeek()->endOfWeek(),
        ])->count();
        $booksChange = $newBooksLastWeek > 0
            ? round((($newBooksThisWeek - $newBooksLastWeek) / $newBooksLastWeek) * 100, 2)
            : 0;

        $booksChart = Trend::model(Member::class)
            ->between(
                start: now()->subWeeks(4),
                end: now()
            )
            ->perWeek()
            ->count()
            ->map(fn(TrendValue $value) => $value->aggregate)
            ->toArray();

        return [
            Stat::make('New Books This Week', $newBooksThisWeek)
                ->description($booksChange >= 0 ? "Active Grow" : "No Grow")
                ->descriptionIcon($booksChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->chart($booksChart)
                ->color($booksChange >= 0 ? 'success' : 'danger'),
        ];
    }
}
