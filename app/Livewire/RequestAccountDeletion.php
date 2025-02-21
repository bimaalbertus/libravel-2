<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;
use Masmerise\Toaster\Toaster;
use App\Models\User;
use Illuminate\Support\Str;

class RequestAccountDeletion extends Component
{
    public string $reason = '';
    public $isOpen = false;


    protected $rules = [
        'reason' => 'required|string|min:10|max:500'
    ];

    public function requestDeletion()
    {
        $this->validate();

        /** @var User $user */
        $user = Auth::user();

        if ($user->messages()
            ->where('type', 'delete_account')
            ->where('status', 'pending')
            ->exists()
        ) {
            Toaster::error(__('profile.account_deletion_request_already_exists'));
            return;
        }

        $user->messages()->create([
            'type' => 'delete_account',
            'reason' => $this->reason,
            'status' => 'pending'
        ]);

        $admins = User::where('status', 'admin')->get();

        foreach ($admins as $admin) {
            Notification::make()
                ->title(__('profile.account_deletion_request'))
                ->body(Str::markdown(__('profile.user_account_deletion_request', [
                    'username' => $user->username,
                    'reason' => $this->reason,
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

        $user->update(['delete_request_at' => now()]);

        $this->isOpen = false;
        $this->reason = '';
        Toaster::success(__('profile.account_deletion_request_sent'));
    }

    public function render()
    {
        return view('livewire.request-account-deletion');
    }
}
