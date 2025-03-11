<?php

namespace App\Filament\Resources\Admin;

use App\Filament\Resources\Admin\CollectionResource\Pages;
use App\Filament\Resources\Admin\CollectionResource\RelationManagers;
use App\Models\Book;
use App\Models\Collection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Pages\SubNavigationPosition;
use Filament\Pages\Page;

class CollectionResource extends Resource
{
    protected static ?string $model = Collection::class;

    protected static ?string $slug = '/collection';
    protected static ?string $navigationIcon = 'heroicon-o-bookmark';
    protected static ?string $navigationGroup = 'Menu';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function getLabel(): string
    {
        return __('collection/fields.page.title');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)
                    ->schema([
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\Section::make()
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->required()
                                            ->label(__('collection/fields.title')),
                                        Forms\Components\Textarea::make('description')
                                            ->label(__('collection/fields.description')),
                                    ]),
                                Forms\Components\Section::make(__('book/fields.label.image.insert.label'))
                                    ->schema([
                                        Forms\Components\Tabs::make('Image Upload Options')
                                            ->tabs([
                                                Forms\Components\Tabs\Tab::make(__('book/fields.label.image.upload.label'))
                                                    ->schema([
                                                        Forms\Components\SpatieMediaLibraryFileUpload::make('uploaded_image')
                                                            ->label(__('book/fields.label.image.upload.label'))
                                                            ->image()
                                                            ->collection('book_collection')
                                                            ->directory('assets/book_collection')
                                                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif'])
                                                            ->maxSize(2048)
                                                    ]),
                                                Forms\Components\Tabs\Tab::make(__('book/fields.label.image.insert.label'))
                                                    ->schema([
                                                        Forms\Components\TextInput::make('image_path')
                                                            ->label(__('book/fields.label.image.insert.desc'))
                                                            ->placeholder('https://example.com/image.jpg')
                                                            ->url()
                                                    ])
                                            ])
                                    ])
                            ])
                            ->columnSpan(2),

                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\Select::make('books')
                                    ->label(__('collection/fields.books.title'))
                                    ->helperText(__('collection/fields.books.desc'))
                                    ->multiple()
                                    ->relationship('books', 'title')
                                    ->preload()
                                    ->required(),
                            ])
                            ->columnSpan(1),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('collection/fields.title'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label(__('collection/fields.description'))
                    ->limit(50),
            ])
            ->filters([
                //
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Section::make()
                    ->schema([
                        Components\Grid::make()
                            ->schema([
                                Components\ImageEntry::make('image_path')
                                    ->hiddenLabel()
                                    ->width('100%')
                                    ->height('auto')
                                    ->alignCenter()
                                    ->grow(false),
                                Components\SpatieMediaLibraryImageEntry::make('image_path')
                                    ->collection('book_collection')
                                    ->hiddenLabel()
                                    ->width('100%')
                                    ->height('auto')
                                    ->alignCenter()
                                    ->grow(false)
                            ])
                    ])
                    ->collapsible(),

                Components\Section::make()
                    ->schema([
                        Components\Split::make([
                            Components\Grid::make(2)
                                ->schema([
                                    Components\Group::make([
                                        Components\TextEntry::make('title')
                                            ->label(__('collection/fields.title'))
                                            ->color('gray'),

                                        Components\TextEntry::make('description')
                                            ->label(__('collection/fields.description'))
                                            ->color('gray'),
                                    ]),
                                ]),
                        ])->from('lg'),
                    ]),

                Components\Section::make(__('collection/fields.books.title'))
                    ->schema(function ($record): array {
                        $books = $record->books;
                        return [
                            Components\ViewEntry::make('books')
                                ->view('filament.resources.collection-resource.image-infolist', ['books' => $books])
                        ];
                    })
                    ->collapsible(),
            ]);
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            Pages\ViewCollection::class,
            Pages\EditCollection::class,
        ]);
    }


    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCollections::route('/'),
            'create' => Pages\CreateCollection::route('/create'),
            'edit' => Pages\EditCollection::route('/{record}/edit'),
            'view' => Pages\ViewCollection::route('/{record}'),
        ];
    }
}
