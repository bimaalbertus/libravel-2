<?php

namespace App\Filament\Resources\Admin;

use App\Filament\Resources\Admin\BannerResource\Pages;
use App\Filament\Resources\Admin\BannerResource\RelationManagers;
use App\Models\Banner;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Component;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components;
use Filament\Pages\Page;
use Filament\Pages\SubNavigationPosition;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;

    protected static ?string $slug = '/banners';
    protected static ?string $navigationIcon = 'heroicon-o-view-columns';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)
                    ->schema([
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\Grid::make()
                                    ->schema([
                                        Forms\Components\Section::make()
                                            ->columnSpan(2)
                                            ->schema([
                                                Forms\Components\Grid::make(2)
                                                    ->schema([
                                                        Forms\Components\TextInput::make('title')
                                                            ->label(__('banner/fields.labels.title'))
                                                            ->required(),
                                                        Forms\Components\TextInput::make('href')
                                                            ->label('Link')
                                                            ->prefix('https://')
                                                            ->placeholder('www.example.com'),
                                                    ]),

                                                Forms\Components\RichEditor::make('content')
                                                    ->label(__('banner/fields.labels.content'))
                                                    ->toolbarButtons([
                                                        'bold',
                                                        'italic',
                                                        'underline',
                                                        'link',
                                                    ]),
                                            ]),
                                    ]),

                                Forms\Components\Grid::make()
                                    ->schema([
                                        Forms\Components\Section::make(__('banner/fields.labels.image'))
                                            ->schema([
                                                Forms\Components\SpatieMediaLibraryFileUpload::make('image')
                                                    ->hiddenLabel()
                                                    ->collection('banners')
                                                    ->image()
                                                    ->imageEditor()
                                                    ->imageEditorMode(2)
                                                    ->imageCropAspectRatio('2.37:1')
                                                    ->disk('public')
                                                    ->directory('banners')
                                                    ->visibility('public'),
                                            ])
                                            ->columnSpan(2)
                                            ->collapsible(),

                                        Forms\Components\Section::make(__('banner/fields.labels.schedule.label'))
                                            ->schema([
                                                Forms\Components\Grid::make(2)
                                                    ->schema([
                                                        Forms\Components\DateTimePicker::make('start_date')
                                                            ->label(__('banner/fields.labels.schedule.start_date'))
                                                            ->required(),
                                                        Forms\Components\DateTimePicker::make('end_date')
                                                            ->label(__('banner/fields.labels.schedule.end_date'))
                                                            ->required(),
                                                    ]),
                                            ])
                                            ->columnSpan(2)
                                            ->collapsible(),
                                    ]),
                            ])
                            ->columnSpan(2),

                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\Section::make('Status')
                                    ->schema([
                                        Forms\Components\Toggle::make('image_only')
                                            ->label(__('banner/fields.labels.image_only.label'))
                                            ->helperText(__('banner/fields.labels.image_only.desc'))
                                            ->default(false),
                                        Forms\Components\Toggle::make('is_active')
                                            ->label(__('banner/fields.labels.is_active.label'))
                                            ->helperText(__('banner/fields.labels.is_active.desc'))
                                            ->default(true),
                                    ])
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
                    ->label(__('banner/fields.labels.title')),
                Tables\Columns\SpatieMediaLibraryImageColumn::make('image')
                    ->label(__('banner/fields.labels.image'))
                    ->collection('banners'),
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label(__('banner/fields.labels.is_active.label')),
                Tables\Columns\ToggleColumn::make('image_only')
                    ->label(__('banner/fields.labels.image_only.label')),
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
                        Components\SpatieMediaLibraryImageEntry::make('image')
                            ->hiddenLabel()
                            ->collection('banners')
                            ->width('100%')
                            ->height('auto')
                            ->alignCenter()
                            ->grow(false),
                    ]),

                Components\Section::make()
                    ->schema([
                        Components\Split::make([
                            Components\Grid::make(2)
                                ->schema([
                                    Components\Group::make([
                                        Components\TextEntry::make('title')
                                            ->label(__('book/fields.label.title')),

                                        Components\TextEntry::make('start_date')
                                            ->label(__('banner/fields.labels.schedule.start_date'))
                                            ->badge()
                                            ->dateTime()
                                            ->color('success'),
                                        Components\TextEntry::make('end_date')
                                            ->label(__('banner/fields.labels.schedule.end_date'))
                                            ->badge()
                                            ->dateTime()
                                            ->color('danger')
                                    ]),
                                ]),
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

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            Pages\ViewBanner::class,
            Pages\EditBanner::class,
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
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'edit' => Pages\EditBanner::route('/{record}/edit'),
            'view' => Pages\ViewBanner::route('/{record}'),
        ];
    }
}
