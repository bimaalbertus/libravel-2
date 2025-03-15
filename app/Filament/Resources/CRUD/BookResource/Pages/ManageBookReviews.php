<?php

namespace App\Filament\Resources\CRUD\BookResource\Pages;

use App\Filament\Resources\CRUD\BookResource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;

class ManageBookReviews extends ManageRelatedRecords
{
    protected static string $resource = BookResource::class;

    protected static string $relationship = 'reviews';

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';

    public function getTitle(): string | Htmlable
    {
        $recordTitle = $this->getRecordTitle();

        $recordTitle = $recordTitle instanceof Htmlable ? $recordTitle->toHtml() : $recordTitle;

        return __('review.manage_title_reviews', ['title' => $recordTitle]);
    }

    public function getBreadcrumb(): string
    {
        return 'Reviews';
    }

    public static function getNavigationLabel(): string
    {
        return ucwords(__('review.manage_reviews'));
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->columns(1)
            ->schema([
                Components\ViewEntry::make('rating')
                    ->label('Rating:')
                    ->view('filament.resources.rating', ['record' => fn($record) => $record]),
                Components\TextEntry::make('user.username')
                    ->color('gray')
                    ->label('Username:'),
                Components\IconEntry::make('is_visible')
                    ->label(__('review.visibility') . ':')
                    ->boolean(),
                Components\TextEntry::make('review_text')
                    ->label(ucfirst(__('review.label')) . ':')
                    ->color('gray')
                    ->markdown(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('rating')
                    ->formatStateUsing(function ($state, $record) {
                        return view('filament.resources.rating', ['record' => $record]);
                    }),

                Tables\Columns\TextColumn::make('user.username')
                    ->label(__('profile.username'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\ToggleColumn::make('is_visible')
                    ->label(__('review.visibility'))
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // 
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->groupedBulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
