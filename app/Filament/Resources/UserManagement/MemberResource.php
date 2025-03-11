<?php

namespace App\Filament\Resources\UserManagement;

use App\Filament\Resources\UserManagement\MemberResource\Pages;
use App\Models\Major;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Pages\SubNavigationPosition;

class MemberResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $slug = 'management/users';
    protected static ?string $navigationGroup = 'User';
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $recordTitleAttribute = 'username';
    protected static ?int $navigationSort = 2;

    public $userClass;

    public static function getLabel(): string
    {
        return __('members/fields.page.title');
    }

    public static function beforeSave($record, array $data)
    {
        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = bcrypt($data['password']);
        }

        return $data;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('fullname')
                    ->label(__('members/fields.fields.fullname'))
                    ->rules(['max:128'])
                    ->regex('/^[\p{L}\s\'-]{3,50}$/u')
                    ->live()
                    ->afterStateUpdated(function (Forms\Contracts\HasForms $livewire, Forms\Components\TextInput $component) {
                        /** @var \Livewire\Component $livewire */
                        $livewire->validateOnly($component->getStatePath());
                    }),
                Forms\Components\TextInput::make('username')
                    ->label(__('members/fields.fields.username'))
                    ->unique('users', 'username', ignoreRecord: true)
                    ->required()
                    ->rules(['alpha_dash', 'min:3', 'max:32'])
                    ->regex('/^[a-zA-Z0-9_-]{3,16}$/')
                    ->live()
                    ->afterStateUpdated(function (Forms\Contracts\HasForms $livewire, Forms\Components\TextInput $component) {
                        /** @var \Livewire\Component $livewire */
                        $livewire->validateOnly($component->getStatePath());
                    }),
                Forms\Components\TextInput::make('password')
                    ->label(__('members/fields.fields.password'))
                    ->password()
                    ->same('password_confirm')
                    ->dehydrateStateUsing(fn($state) => !empty($state) ? bcrypt($state) : null)
                    ->dehydrated(fn($state) => filled($state))
                    ->required(fn($livewire) => $livewire instanceof Pages\CreateMember),
                Forms\Components\TextInput::make('password_confirm')
                    ->label(__('members/fields.fields.password_confirm'))
                    ->password()
                    ->same('password')
                    ->dehydrateStateUsing(fn($state) => !empty($state) ? bcrypt($state) : null)
                    ->dehydrated(fn($state) => filled($state))
                    ->required(fn($livewire) => $livewire instanceof Pages\CreateMember),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'teacher' => __('members/fields.fields.status.teacher'),
                        'student' => __('members/fields.fields.status.student')
                    ])
                    ->required(),
                Forms\Components\Radio::make('gender')
                    ->label(__('members/fields.fields.gender.label'))
                    ->default(fn($record) => $record->gender)
                    ->options(['male' => __('members/fields.fields.gender.male'), 'female' => __('members/fields.fields.gender.female')]),
                Forms\Components\Select::make('major')
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
                Tables\Columns\TextColumn::make('fullname')
                    ->label(__('members/fields.fields.fullname'))
                    ->searchable()
                    ->sortable()
                    ->weight('medium')
                    ->color('gray'),
                Tables\Columns\TextColumn::make('username')
                    ->label(__('members/fields.fields.username'))
                    ->searchable()
                    ->sortable()
                    ->color(fn($record) => $record->delete_request_at ? 'danger' : 'white'),
                Tables\Columns\TextColumn::make('status')
                    ->formatStateUsing(fn($state) => __("members/fields.fields.status.{$state}")),
                Tables\Columns\TextColumn::make('gender')
                    ->formatStateUsing(fn($state) => __("members/fields.fields.gender.{$state}")),
                Tables\Columns\TextColumn::make('major')
                    ->label(__('members/fields.fields.major'))
                    ->formatStateUsing(fn($state) => strtoupper($state)),
                Tables\Columns\ToggleColumn::make('is_admin')
                    ->label('Admin')
                    ->disabled(fn($record) => $record->id === 1),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'teacher' => __('members/fields.fields.status.teacher'),
                        'student' => __('members/fields.fields.status.student')
                    ]),
                Tables\Filters\SelectFilter::make('gender')
                    ->label(__('members/fields.fields.gender.label'))
                    ->options([
                        'male' => __('members/fields.fields.gender.male'),
                        'female' => __('members/fields.fields.gender.female')
                    ]),
                Tables\Filters\SelectFilter::make('major')
                    ->label(__('members/fields.fields.major'))
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
