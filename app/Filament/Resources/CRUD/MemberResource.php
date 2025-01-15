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
use Filament\Notifications\Notification;
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
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?int $navigationSort = 2;

    public static function getLabel(): string
    {
        return __('members/fields.page.title');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('fullname')
                    ->label(__('members/fields.fields.fullname'))
                    ->required()
                    ->rules(['max:128'])
                    ->live()
                    ->afterStateUpdated(function (Forms\Contracts\HasForms $livewire, Forms\Components\TextInput $component) {
                        /** @var \Livewire\Component $livewire */
                        $livewire->validateOnly($component->getStatePath());
                    }),
                TextInput::make('username')
                    ->label(__('members/fields.fields.username'))
                    ->unique('members', 'username', ignoreRecord: true)
                    ->required()
                    ->rules(['alpha_dash', 'min:3', 'max:32'])
                    ->live()
                    ->afterStateUpdated(function (Forms\Contracts\HasForms $livewire, Forms\Components\TextInput $component) {
                        /** @var \Livewire\Component $livewire */
                        $livewire->validateOnly($component->getStatePath());
                    }),
                TextInput::make('password')
                    ->label(__('members/fields.fields.password'))
                    ->password()
                    ->required(),
                Select::make('status')
                    ->label('Status')
                    ->options(['teacher' => __('members/fields.fields.status.teacher'), 'student' => __('members/fields.fields.status.student')])
                    ->required(),
                Radio::make('gender')
                    ->label(__('members/fields.fields.gender.label'))
                    ->options(['male' => __('members/fields.fields.gender.male'), 'female' => __('members/fields.fields.gender.female')])
                    ->required(),
                Select::make('major')
                    ->label(__('members/fields.fields.major'))
                    ->options(Major::query()->pluck('name', 'abbreviation')->toArray())
                    ->searchable()
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('fullname')
                    ->label(__('members/fields.fields.fullname'))
                    ->searchable()
                    ->sortable()
                    ->weight('medium'),
                TextColumn::make('username')
                    ->label(__('members/fields.fields.username'))
                    ->searchable()
                    ->sortable()
                    ->color('gray'),
                TextColumn::make('status')
                    ->formatStateUsing(fn($state) => __("members/fields.fields.status.{$state}")),
                TextColumn::make('gender')
                    ->formatStateUsing(fn($state) => __("members/fields.fields.gender.{$state}")),
                TextColumn::make('major')
                    ->label(__('members/fields.fields.major'))
                    ->formatStateUsing(fn($state) => strtoupper($state)),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'teacher' => 'Teacher',
                        'student' => 'Student',
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
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->action(function () {
                            Notification::make()
                                ->title('Now, now, don\'t be cheeky, leave some records for others to play with!')
                                ->warning()
                                ->send();
                        }),
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
        ];
    }
}
