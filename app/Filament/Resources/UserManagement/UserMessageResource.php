<?php

namespace App\Filament\Resources\UserManagement;

use App\Filament\Resources\UserManagement\UserMessageResource\Pages;
use App\Filament\Resources\UserManagement\UserMessageResource\RelationManagers;
use App\Models\UserMessage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserMessageResource extends Resource
{
    protected static ?string $model = UserMessage::class;

    protected static ?string $slug = 'management/users-message';
    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationGroup = 'User';

    public static function getLabel(): string
    {
        return __('members/members-messages.page.title');
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.username')
                    ->label('Username')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\SelectColumn::make('type')
                    ->label(__('members/members-messages.fields.type.label'))
                    ->options([
                        'delete_account' => __('members/members-messages.fields.type.options.delete_account'),
                        'change_username' => __('members/members-messages.fields.type.options.change_username'),
                        'other' => __('members/members-messages.fields.type.options.other')
                    ])
                    ->disabled(),
                Tables\Columns\TextColumn::make('reason')
                    ->label(__('members/members-messages.fields.reason'))
                    ->limit(50),
                Tables\Columns\TextColumn::make('requested_value')
                    ->label(__('members/members-messages.fields.requested_value')  . ' (username)'),
                Tables\Columns\SelectColumn::make('status')
                    ->label(__('members/members-messages.fields.status.label'))
                    ->options([
                        'pending' => __('members/members-messages.fields.status.pending'),
                        'approved' => __('members/members-messages.fields.status.approved'),
                        'rejected' => __('members/members-messages.fields.status.rejected')
                    ])
                    ->disabled(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('members/members-messages.fields.created_at'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => __('members/members-messages.fields.status.pending'),
                        'approved' => __('members/members-messages.fields.status.approved'),
                        'rejected' => __('members/members-messages.fields.status.rejected')
                    ]),
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'delete_account' => __('members/members-messages.fields.type.options.delete_account'),
                        'change_username' => __('members/members-messages.fields.type.options.change_username'),
                        'other' => __('members/members-messages.fields.type.options.other')
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('approve')
                    ->label(__('members/members-messages.actions.approve.label') . '?')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn(UserMessage $record) => $record->status === 'pending')
                    ->action(function (UserMessage $record) {
                        if ($record->type === 'delete_account') {
                            $user = $record->user;
                            $user->delete();

                            Notification::make()
                                ->success()
                                ->title(__('members/members-messages.actions.approve.message'))
                                ->send();
                        } elseif ($record->type === 'change_username') {
                            $user = $record->user;
                            $user->username = $record->requested_value;
                            $user->save();
                        }

                        $record->update([
                            'status' => 'approved',
                            'processed_at' => now()
                        ]);
                    }),

                Tables\Actions\Action::make('reject')
                    ->label(__('members/members-messages.actions.reject.label') . '?')
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->visible(fn(UserMessage $record) => $record->status === 'pending')
                    ->action(function (UserMessage $record) {
                        $record->update([
                            'status' => 'rejected',
                            'processed_at' => now()
                        ]);
                    }),
            ])
            ->defaultSort('created_at', 'desc')
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
            'index' => Pages\ListUserMessages::route('/'),
        ];
    }
}
