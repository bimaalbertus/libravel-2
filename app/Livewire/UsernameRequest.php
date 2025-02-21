<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;
use Masmerise\Toaster\Toaster;
use App\Models\User;
use Illuminate\Support\Str;

class UsernameRequest extends Component
{
    public string $reason = '';
    public string $new_username;
    public $isOpen = false;

    protected $rules = [
        'reason' => 'required|min:10|max:500',
        'new_username' => 'required|string|max:32|unique:users,username'
    ];

    public function send()
    {
        $this->validate();

        /** @var User $user */
        $user = Auth::user();

        if ($user->messages()
            ->where('type', 'change_username')
            ->where('status', 'pending')
            ->exists()
        ) {
            Toaster::error(__('profile.username_request_already_exists'));
            return;
        }

        $user->messages()->create([
            'type' => 'change_username',
            'reason' => $this->reason,
            'requested_value' => $this->new_username,
            'status' => 'pending'
        ]);

        $admins = User::where('status', 'admin')->get();

        foreach ($admins as $admin) {
            Notification::make()
                ->title(__('profile.username_request'))
                ->body(Str::markdown(__('profile.username_requested', [
                    'username' => $user->username,
                    'new_username' => $this->new_username,
                ])))
                ->actions([
                    \Filament\Notifications\Actions\Action::make('detail')
                        ->button()
                        ->url(
                            '/admin/management/users-message?tableSearch=' .
                                $user->username,
                            shouldOpenInNewTab: true
                        ),
                ])
                ->sendToDatabase($admin, false);
        }

        $this->isOpen = false;
        $this->new_username = '';
        $this->reason = '';
        Toaster::success(__('profile.username_request_sent'));
    }

    public function render()
    {
        return view('livewire.username-request');
    }
}
