<?php

namespace App\Filament\Resources\Admin;

use App\Filament\Resources\Admin\PageSettingsResource\Pages;
use App\Filament\Resources\PageSettingsResource\RelationManagers;
use App\Models\PageSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PageSettingsResource extends Resource
{
    protected static ?string $model = PageSettings::class;

    protected static ?string $slug = '/page-settings';
    protected static ?string $navigationGroup = 'Menu';
    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('key')
                    ->label('Key')
                    ->required()
                    ->disabled()
                    ->maxLength(255),

                Forms\Components\Toggle::make('value')
                    ->label('Value')
                    ->default(true)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->label('Pengaturan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('value')
                    ->label('Status'),
            ])
            ->filters([
                //
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPageSettings::route('/'),
            'create' => Pages\CreatePageSettings::route('/create'),
            'edit' => Pages\EditPageSettings::route('/{record}/edit'),
        ];
    }
}
