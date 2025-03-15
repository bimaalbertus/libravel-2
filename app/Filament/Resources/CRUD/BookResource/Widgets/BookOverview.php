<?php

namespace App\Filament\Resources\CRUD\BookResource\Widgets;

use App\Filament\Resources\CRUD\BookResource\Pages\ListBooks;
use App\Models\Book;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class BookOverview extends BaseWidget
{
    use InteractsWithPageTable;

    protected static ?string $pollingInterval = null;

    protected function getTablePage(): string
    {
        return ListBooks::class;
    }

    protected function getStats(): array
    {
        return array_merge(
            $this->getTotalBooks(),
            $this->getWeekStats(),
            $this->getBooksPublishedThisYear(),
        );
    }

    private function getTotalBooks(): array
    {
        $bookData = Trend::model(Book::class)
            ->between(
                start: now()->subYear(),
                end: now(),
            )
            ->perMonth()
            ->count();

        return [
            Stat::make('Total', $this->getPageTableQuery()->count())
                ->chart(
                    $bookData
                        ->map(fn(TrendValue $value) => $value->aggregate)
                        ->toArray()
                ),
        ];
    }

    private function getWeekStats(): array
    {
        $newBooksThisWeek = Book::where('created_at', '>=', now()->subDays(7))->count();
        $newBooksLastWeek = Book::whereBetween('created_at', [
            now()->subWeek()->startOfWeek(),
            now()->subWeek()->endOfWeek(),
        ])->count();

        $booksChange = $newBooksLastWeek > 0
            ? round((($newBooksThisWeek - $newBooksLastWeek) / $newBooksLastWeek) * 100, 2)
            : ($newBooksThisWeek > 0 ? 100 : 0);

        $booksChart = Trend::model(Book::class)
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

    private function getBooksPublishedThisYear(): array
    {
        $booksThisYear = Book::whereYear('release_date', now()->year)->count();

        return [
            Stat::make('Books This Year', $booksThisYear)
                ->description('Books published in ' . now()->year)
                ->color('info'),
        ];
    }
}
