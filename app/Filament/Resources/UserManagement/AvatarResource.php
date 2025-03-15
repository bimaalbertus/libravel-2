<?php

namespace App\Filament\Resources\UserManagement;

use App\Filament\Resources\UserManagement\AvatarResource\Pages;
use App\Models\Avatar;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;

class AvatarResource extends Resource
{
    protected static ?string $model = Avatar::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $slug = 'management/avatars';
    protected static ?string $navigationGroup = 'User';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(1)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label(__('filament-edit-profile::default.name'))
                            ->required()
                            ->maxLength(255)
                            ->default(function () {
                                $count = Avatar::count();
                                return 'avatar-' . ($count + 1);
                            }),
                        Forms\Components\SpatieMediaLibraryFileUpload::make('avatar')
                            ->collection('avatars')
                            ->disk('public')
                            ->directory('avatars')
                            ->image()
                            ->imagePreviewHeight('250')
                            ->imageCropAspectRatio('1:1')
                            ->imageResizeTargetWidth('500')
                            ->imageResizeTargetHeight('500')
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('filament-edit-profile::default.name')),
                Tables\Columns\ImageColumn::make('media.file_name')
                    ->getStateUsing(fn(Avatar $record): ?string => $record->getFirstMediaUrl('avatars')),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListAvatars::route('/'),
        ];
    }
}
