<?php

namespace App\Filament\Resources\CRUD;

use App\Filament\Resources\CRUD\MemberResource\Pages;
use App\Filament\Resources\CRUD\MemberResource\RelationManagers;
use App\Models\Member;
use App\Models\Major;
use Filament\Forms;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;

    protected static ?string $slug = 'crud/members';
    protected static ?string $navigationGroup = 'CRUD';
    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('fullname')->label('Full Name')->required(),
                TextInput::make('username')->unique('members', 'username', ignoreRecord: true)->required(),
                TextInput::make('password')->password()->required(),
                Select::make('status')
                    ->options(['teacher' => 'Teacher', 'student' => 'Student', 'employee' => 'Employee'])
                    ->required(),
                Radio::make('gender')
                    ->options(['male' => 'Male', 'female' => 'Female'])
                    ->required(),
                Select::make('major')
                    ->label('Major')
                    ->options(Major::query()->pluck('name', 'abbreviation')->toArray())
                    ->searchable()
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('fullname')->label('Full Name')->searchable()->sortable(),
                TextColumn::make('username')->searchable()->sortable(),
                TextColumn::make('status')->formatStateUsing(fn($state) => ucfirst($state)),
                TextColumn::make('gender')->formatStateUsing(fn($state) => ucfirst($state)),
                TextColumn::make('major')->label('Major')->formatStateUsing(fn($state) => strtoupper($state)),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'teacher' => 'Teacher',
                        'student' => 'Student',
                        'employee' => 'Employee',
                    ]),
                SelectFilter::make('gender')
                    ->label('Gender')
                    ->options([
                        'male' => 'Male',
                        'female' => 'Female',
                    ]),
                SelectFilter::make('major')
                    ->label('Major')
                    ->options(
                        Major::query()->pluck('name', 'abbreviation')->toArray()
                    ),
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
            'index' => Pages\ListMembers::route('/'),
            'create' => Pages\CreateMember::route('/create'),
            'edit' => Pages\EditMember::route('/{record}/edit'),
        ];
    }
}
