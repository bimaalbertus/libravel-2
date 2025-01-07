<?php

namespace App\Filament\Resources\AdminResource\Widgets;

use App\Filament\Resources\CRUD\BookResource;
use App\Models\Book;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Columns\{TextColumn,  IconColumn};


class LatestBooks extends BaseWidget
{
    protected static ?string $pollingInterval = '10s';
    protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(BookResource::getEloquentQuery())
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('created_at')->label('Added Date')->date('Y-m-d')->sortable(),
                TextColumn::make('title')->label('Title')->searchable()->sortable(),
                TextColumn::make('language')->label('Language')->sortable(),
                TextColumn::make('page_count')->label('Page Count')->sortable(),
                IconColumn::make('is_fiction')->boolean()->label('Fiction'),
                TextColumn::make('release_date')->label('Release Date')->date('Y-m-d'),
            ])
            ->actions([
                Tables\Actions\Action::make('open')
                    ->url(fn(Book $record): string => BookResource::getUrl('edit', ['record' => $record])),
            ]);
    }
}
