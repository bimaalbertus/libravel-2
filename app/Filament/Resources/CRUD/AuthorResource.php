<?php

namespace App\Filament\Resources\CRUD;

use App\Filament\Resources\CRUD\AuthorResource\Pages;
use App\Models\Author;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Filament\Infolists\Components;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Pages\Page;
use Filament\Pages\SubNavigationPosition;

class AuthorResource extends Resource
{
    protected static ?string $model = Author::class;

    protected static ?string $slug = 'crud/author';
    protected static ?string $navigationGroup = 'CRUD';
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $recordTitleAttribute = 'fullname';
    protected static ?int $navigationSort = 1;
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function getLabel(): string
    {
        return __('book/fields.label.author');
    }

    public static function getGlobalSearchResultUrl(Model $record): string
    {
        return AuthorResource::getUrl('view', ['record' => $record]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\Section::make()
                                    ->schema([
                                        Forms\Components\Grid::make()
                                            ->schema([
                                                Forms\Components\TextInput::make('fullname')
                                                    ->label(__('profile.fullname'))
                                                    ->required()
                                                    ->live(onBlur: true)
                                                    ->maxLength(255)
                                                    ->afterStateUpdated(fn(string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', \Illuminate\Support\Str::slug($state)) : null),
                                                Forms\Components\TextInput::make('slug')
                                                    ->label(__('book/fields.label.slug'))
                                                    ->disabled()
                                                    ->dehydrated()
                                                    ->maxLength(255),
                                            ]),
                                        Forms\Components\RichEditor::make('bio')
                                            ->label(ucfirst(__('author.bio')))
                                            ->columnSpan('full')
                                            ->maxLength(65535),
                                    ])
                                    ->columns(2)
                                    ->columnSpan(['lg' => 2]),

                                Forms\Components\Section::make(__('book/fields.label.image.upload.label'))
                                    ->schema([
                                        Forms\Components\Tabs::make('Image Upload Options')
                                            ->tabs([
                                                Forms\Components\Tabs\Tab::make(__('book/fields.label.image.upload.label'))
                                                    ->schema([
                                                        Forms\Components\SpatieMediaLibraryFileUpload::make('uploaded_image')
                                                            ->label(__('book/fields.label.image.upload.label'))
                                                            ->image()
                                                            ->collection('authors')
                                                            ->disk('public')
                                                            ->directory('authors')
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
                                    ->columnSpan(['lg' => 2])
                                    ->collapsible(),

                                Forms\Components\Section::make(__('book/fields.label.details.label'))
                                    ->schema([
                                        Forms\Components\Grid::make()
                                            ->schema([
                                                Forms\Components\DatePicker::make('birthdate')
                                                    ->label(ucfirst(__('author.birth')))
                                                    ->required()
                                                    ->native(false)
                                                    ->displayFormat('Y-m-d')
                                                    ->prefixIcon('heroicon-o-calendar'),
                                                Forms\Components\DatePicker::make('deathdate')
                                                    ->label(ucfirst(__('author.death')))
                                                    ->native(false)
                                                    ->displayFormat('Y-m-d')
                                                    ->prefixIcon('heroicon-o-calendar'),
                                            ])
                                            ->columns(['lg' => 2]),
                                    ])
                                    ->collapsible(),
                            ])
                            ->columnSpan(['lg' => 2]),

                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\Section::make()
                                    ->schema([
                                        Forms\Components\Select::make('books')
                                            ->label(__('book/fields.page.title'))
                                            ->multiple()
                                            ->relationship('books', 'title', fn($query) => $query->orderBy('title'))
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
                Tables\Columns\ImageColumn::make('image_path')
                    ->label(__('book/fields.label.image.insert.label')),

                Tables\Columns\TextColumn::make('fullname')
                    ->label(__('profile.fullname'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('birthdate')
                    ->label(ucfirst(__('author.birth')))
                    ->date('Y-m-d')
                    ->sortable(),

                Tables\Columns\TextColumn::make('deathdate')
                    ->label(ucfirst(__('author.death')))
                    ->date('Y-m-d')
                    ->sortable(),
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
                Components\Grid::make(2)
                    ->schema([
                        Components\Section::make()
                            ->schema([
                                Components\Split::make([
                                    Components\ImageEntry::make('image_path')
                                        ->hiddenLabel()
                                        ->getStateUsing(function ($record) {
                                            return $record->getCoverPath();
                                        })
                                        ->width(200)
                                        ->height(300)
                                        ->grow(false),
                                    Components\Grid::make(1)
                                        ->schema([
                                            Components\Grid::make()
                                                ->schema([
                                                    Components\TextEntry::make('fullname')
                                                        ->label(__('profile.fullname')),

                                                    Components\TextEntry::make('slug')
                                                        ->label(__('book/fields.label.slug'))
                                                        ->color('gray'),

                                                    Components\TextEntry::make('birthdate')
                                                        ->label(ucfirst(__('author.birth')))
                                                        ->badge()
                                                        ->date(),
                                                    Components\TextEntry::make('deathdate')
                                                        ->label(ucfirst(__('author.death')))
                                                        ->badge()
                                                        ->date(),
                                                ]),
                                            Components\TextEntry::make('bio')
                                                ->label(ucfirst(__('author.bio')))
                                                ->prose()
                                                ->markdown(),
                                        ]),
                                ])->from('lg'),
                            ]),

                        Components\Section::make(__('book/fields.page.title'))
                            ->schema(function ($record): array {
                                $books = $record->books;
                                return [
                                    Components\ViewEntry::make('books')
                                        ->view('filament.resources.collection-resource.image-infolist', ['books' => $books])
                                ];
                            })
                            ->collapsible(),
                    ])
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            Pages\ViewAuthor::class,
            Pages\EditAuthor::class,
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAuthors::route('/'),
            'create' => Pages\CreateAuthor::route('/create'),
            'edit' => Pages\EditAuthor::route('/{record}/edit'),
            'view' => Pages\ViewAuthor::route('/{record}'),
        ];
    }
}
