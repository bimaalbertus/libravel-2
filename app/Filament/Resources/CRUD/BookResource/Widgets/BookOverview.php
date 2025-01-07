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
}
