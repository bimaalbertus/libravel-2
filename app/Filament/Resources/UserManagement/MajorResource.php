<?php

namespace App\Filament\Resources\UserManagement;

use App\Filament\Resources\UserManagement\MajorResource\Pages;
use App\Filament\Resources\UserManagement\MajorResource\RelationManagers;
use App\Models\Major;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MajorResource extends Resource
{
    protected static ?string $model = Major::class;

    protected static ?string $slug = 'crud/majors';
    protected static ?string $navigationGroup = 'User';
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function getLabel(): string
    {
        return __('major/fields.page.title');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('major/fields.fields.name'))
                    ->required()
                    ->maxLength(255),
                TextInput::make('abbreviation')
                    ->label(__('major/fields.fields.abbreviation'))
                    ->required()
                    ->unique()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('major/fields.fields.name'))
                    ->searchable(),
                TextColumn::make('abbreviation')
                    ->label(__('major/fields.fields.abbreviation'))
                    ->formatStateUsing(fn($state) => strtoupper($state))
                    ->searchable(),
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
            'index' => Pages\ListMajors::route('/'),
        ];
    }
}
