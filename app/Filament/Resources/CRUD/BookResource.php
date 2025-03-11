<?php

namespace App\Filament\Resources\CRUD;

use App\Filament\Resources\CRUD\BookResource\Pages;
use App\Filament\Resources\CRUD\BookResource\Widgets\BookOverview;
use App\Models\Book;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

use Filament\Forms\Components\{TextInput, DatePicker, FileUpload, RichEditor, Section, Grid, Tabs, Toggle, Select, SpatieMediaLibraryFileUpload};
use Filament\Forms\Components\Tabs\Tab;
use Filament\Tables\Columns\{TextColumn,  IconColumn, ImageColumn};
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Pages\Page;
use Filament\Pages\SubNavigationPosition;
use Illuminate\Database\Eloquent\Model;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;

    protected static ?string $slug = 'crud/book';
    protected static ?string $navigationGroup = 'CRUD';
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $recordTitleAttribute = 'title';
    protected static ?int $navigationSort = 1;
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function getLabel(): string
    {
        return __('book/fields.page.title');
    }

    public static function getGlobalSearchResultUrl(Model $record): string
    {
        return BookResource::getUrl('view', ['record' => $record]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                    ->schema([
                        Grid::make()
                            ->schema([
                                Section::make()
                                    ->schema([
                                        Grid::make()
                                            ->schema([
                                                TextInput::make('title')
                                                    ->label(__('book/fields.label.title'))
                                                    ->required()
                                                    ->live(onBlur: true)
                                                    ->maxLength(255)
                                                    ->afterStateUpdated(fn(string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                                                TextInput::make('slug')
                                                    ->label(__('book/fields.label.slug'))
                                                    ->disabled()
                                                    ->dehydrated()
                                                    ->maxLength(255),
                                            ]),
                                        RichEditor::make('synopsis')
                                            ->label(__('book/fields.label.synopsis'))
                                            ->columnSpan('full')
                                            ->maxLength(65535),
                                    ])
                                    ->columns(2)
                                    ->columnSpan(['lg' => 2]),

                                Section::make(__('book/fields.label.image.upload.label'))
                                    ->schema([
                                        Tabs::make('Image Upload Options')
                                            ->tabs([
                                                Tab::make(__('book/fields.label.image.upload.label'))
                                                    ->schema([
                                                        SpatieMediaLibraryFileUpload::make('uploaded_image')
                                                            ->label(__('book/fields.label.image.upload.label'))
                                                            ->image()
                                                            ->collection('books')
                                                            ->disk('public')
                                                            ->directory('books/cover')
                                                    ]),
                                                Tab::make(__('book/fields.label.image.insert.label'))
                                                    ->schema([
                                                        TextInput::make('image_path')
                                                            ->label(__('book/fields.label.image.insert.desc'))
                                                            ->placeholder('https://example.com/image.jpg')
                                                            ->url()
                                                    ])
                                            ])
                                    ])
                                    ->columnSpan(['lg' => 2])
                                    ->collapsible(),

                                Section::make('file')
                                    ->schema([
                                        SpatieMediaLibraryFileUpload::make('uploaded_file')
                                            ->label(__('book/fields.label.image.upload.label'))
                                            ->collection('book.documents')
                                            ->disk('public')
                                            ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                                            ->directory('books/documents')
                                    ]),

                                Section::make(__('book/fields.label.details.label'))
                                    ->schema([
                                        Grid::make()
                                            ->schema([
                                                DatePicker::make('release_date')
                                                    ->label(__('book/fields.label.status.release_date.label'))
                                                    ->required()
                                                    ->native(false)
                                                    ->displayFormat('Y-m-d')
                                                    ->prefixIcon('heroicon-o-calendar'),
                                                Select::make('language')
                                                    ->label(__('book/fields.label.details.lang.label'))
                                                    ->preload()
                                                    ->required()
                                                    ->placeholder(__('book/fields.label.details.lang.desc'))
                                                    ->options([
                                                        'en' => 'English',
                                                        'id' => 'Bahasa Indonesia'
                                                    ]),
                                            ])
                                            ->columns(['lg' => 2]),
                                        TextInput::make('page_count')
                                            ->label(__('book/fields.label.details.page_count.label'))
                                            ->numeric()
                                            ->minValue(1)
                                            ->required()
                                            ->helperText(__('book/fields.label.details.page_count.desc')),
                                    ])
                                    ->collapsible(),
                            ])
                            ->columnSpan(['lg' => 2]),

                        Grid::make()
                            ->schema([
                                Section::make('Status')
                                    ->schema([
                                        Toggle::make('is_fiction')
                                            ->label(__('book/fields.label.status.is_fiction.label'))
                                            ->helperText(__('book/fields.label.status.is_fiction.desc')),
                                        Toggle::make('is_teachers_book')
                                            ->label(__('book/fields.label.status.is_teachers_book.label'))
                                            ->helperText(__('book/fields.label.status.is_teachers_book.desc')),
                                    ]),
                                Section::make()
                                    ->schema([
                                        Select::make('genres')
                                            ->multiple()
                                            ->relationship('genres', 'key', fn($query) => $query->orderBy('key'))
                                            ->getOptionLabelFromRecordUsing(fn($record) => __("genres/genres.{$record->key}"))
                                            ->preload()
                                            ->searchable()
                                            ->placeholder(__('book/fields.label.genres.desc'))
                                            ->label(__('book/fields.label.genres.label')),
                                        Select::make('authors')
                                            ->label(__('book/fields.label.author'))
                                            ->multiple()
                                            ->relationship('authors', 'fullname', fn($query) => $query->orderBy('fullname'))
                                            ->preload()
                                            ->searchable(),
                                    ])
                            ])
                            ->columnSpan(['lg' => 1]),
                    ])->columns(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')
                    ->label(__('book/fields.label.image.insert.label')),

                TextColumn::make('title')
                    ->label(__('book/fields.label.title'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('language')
                    ->label(__('book/fields.label.details.lang.label'))
                    ->sortable(),

                TextColumn::make('page_count')
                    ->label(__('book/fields.label.details.page_count.label'))
                    ->sortable(),

                IconColumn::make('is_fiction')
                    ->boolean()
                    ->label(__('book/fields.label.status.is_fiction.title')),

                TextColumn::make('release_date')
                    ->label(__('book/fields.label.status.release_date.label'))
                    ->date('Y-m-d')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('language')
                    ->label(__('book/fields.label.details.lang.label'))
                    ->options([
                        'en' => 'English',
                        'es' => 'Spanish',
                        'fr' => 'France',
                        'gr' => 'German',
                        'id' => 'Bahasa Indonesia',
                        'jp' => 'Japan',
                    ]),

                TernaryFilter::make('is_fiction')
                    ->label(__('book/fields.label.status.is_fiction.title'))
                    ->trueLabel(__('book/fields.label.status.is_fiction.title'))
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
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            Pages\ViewBook::class,
            Pages\EditBook::class,
        ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Section::make()
                    ->schema([
                        Components\Split::make([
                            Components\Grid::make(2)
                                ->schema([
                                    Components\Group::make([
                                        Components\TextEntry::make('title')
                                            ->label(__('book/fields.label.title')),

                                        Components\TextEntry::make('slug')
                                            ->label(__('book/fields.label.slug'))
                                            ->color('gray'),

                                        Components\TextEntry::make('release_date')
                                            ->label(__('book/fields.label.status.release_date.label'))
                                            ->badge()
                                            ->date()
                                            ->color('success'),
                                    ]),


                                    Components\Group::make([
                                        Components\TextEntry::make('authors.fullname')
                                            ->label(__('book/fields.label.author')),

                                        Components\TextEntry::make('is_fiction')
                                            ->label(__('book/fields.label.status.is_fiction.title'))
                                            ->getStateUsing(fn($record) => $record->is_fiction ? 'true' : 'false')
                                            ->color(fn($record) => $record->is_fiction ? 'success' : 'danger'),

                                        Components\TextEntry::make('is_teachers_book')
                                            ->label(__('book/fields.label.status.is_teachers_book.title'))
                                            ->getStateUsing(fn($record) => $record->is_teachers_book ? 'true' : 'false')
                                            ->color(fn($record) => $record->is_teachers_book ? 'success' : 'danger'),

                                        Components\TextEntry::make('genres.key')
                                            ->label(__('book/fields.label.genres.label'))
                                            ->getStateUsing(function ($record) {
                                                return $record->genres->pluck('key')->map(fn($key) => __("genres/genres.{$key}"))->join(', ');
                                            }),
                                    ]),
                                ]),

                            Components\ImageEntry::make('image_path')
                                ->hiddenLabel()
                                ->width(200)
                                ->height(300)
                                ->grow(false),
                            SpatieMediaLibraryImageEntry::make('image_path')
                                ->collection('books')
                                ->hiddenLabel()
                                ->width(200)
                                ->height(300)
                                ->grow(false)
                        ])->from('lg'),
                    ]),


                Components\Section::make('Synopsis')
                    ->schema([
                        Components\TextEntry::make('synopsis')
                            ->label(__('book/fields.label.synopsis'))
                            ->prose()
                            ->markdown()
                            ->hiddenLabel(),
                    ])
                    ->collapsible(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBooks::route('/'),
            'create' => Pages\CreateBook::route('/create'),
            'edit' => Pages\EditBook::route('/{record}/edit'),
            'view' => Pages\ViewBook::route('/{record}'),
        ];
    }
}
