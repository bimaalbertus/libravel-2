<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;
use Masmerise\Toaster\Toaster;

class RequestAccountDeletion extends Component
{
    public function requestDeletion()
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user->delete_request_at) {
            Toaster::success('Anda sudah mengajukan permintaan penghapusan akun.');
            return;
        }

        $user->update([
            'delete_request_at' => now(),
        ]);

        $recipient = Auth::user();
        Notification::make()
            ->title('Permintaan Penghapusan Akun')
            ->body("Pengguna {$user->username} meminta penghapusan akunnya.")
            ->sendToDatabase($recipient);

        Toaster::success('Permintaan penghapusan akun telah dikirim ke admin.');
    }

    public function render()
    {
        return view('livewire.request-account-deletion');
    }
}
