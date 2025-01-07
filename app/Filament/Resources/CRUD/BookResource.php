<?php

namespace App\Filament\Resources\CRUD;

use App\Filament\Resources\CRUD\BookResource\Pages;
use App\Filament\Resources\CRUD\BookResource\RelationManagers;
use App\Filament\Resources\CRUD\BookResource\Widgets\BookOverview;
use App\Models\Book;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\{TextInput, Textarea, DatePicker, Checkbox};
use Filament\Tables\Columns\{TextColumn,  IconColumn};
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;

    protected static ?string $slug = 'crud/book';
    protected static ?string $navigationGroup = 'CRUD';
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $recordTitleAttribute = 'number';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Book Title')
                    ->required()
                    ->maxLength(255),

                Textarea::make('synopsis')
                    ->label('Synopsis')
                    ->rows(4)
                    ->maxLength(65535),

                TextInput::make('language')
                    ->label('Language')
                    ->maxLength(100),

                TextInput::make('cover_path')
                    ->label('Cover Path')
                    ->hint('URL or file path to the book cover image'),

                TextInput::make('page_count')
                    ->label('Page Count')
                    ->numeric()
                    ->minValue(1),

                DatePicker::make('release_date')
                    ->label('Release Date')
                    ->displayFormat('Y-m-d'),

                Checkbox::make('is_fiction')
                    ->label('Is Fiction')
                    ->default(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Title')->searchable()->sortable(),
                TextColumn::make('language')->label('Language')->sortable(),
                TextColumn::make('page_count')->label('Page Count')->sortable(),
                IconColumn::make('is_fiction')->boolean()->label('Fiction'),
                TextColumn::make('release_date')->label('Release Date')->date('Y-m-d'),
            ])
            ->filters([
                SelectFilter::make('language')
                    ->label('Language')
                    ->options([
                        'en' => 'English',
                        'es' => 'Spanish',
                        'fr' => 'France',
                        'gr' => 'German',
                        'id' => 'Indonesia',
                        'jp' => 'Japan',
                    ]),

                TernaryFilter::make('is_fiction')
                    ->label('Fiction')
                    ->trueLabel('Fiction')
                    ->falseLabel('Non-Fiction'),
                Filter::make('release_date')
                    ->form([
                        DatePicker::make('from')->label('From'),
                        DatePicker::make('to')->label('To'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['from'], fn($q) => $q->where('release_date', '>=', $data['from']))
                            ->when($data['to'], fn($q) => $q->where('release_date', '<=', $data['to']));
                    })
                    ->indicateUsing(function (array $data) {
                        $indicators = [];

                        if ($data['from'] ?? null) {
                            $indicators['from'] = 'From: ' . $data['from'];
                        }

                        if ($data['to'] ?? null) {
                            $indicators['to'] = 'To: ' . $data['to'];
                        }

                        return $indicators;
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getWidgets(): array
    {
        return [
            BookOverview::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBooks::route('/'),
            'create' => Pages\CreateBook::route('/create'),
            'edit' => Pages\EditBook::route('/{record}/edit'),
        ];
    }
}
