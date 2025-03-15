<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class DeleteAccount extends Component
{
    public $password;
    public $isOpen = false;

    public function submit()
    {
        $this->validate([
            'password' => 'required|string|min:8|max:255',
        ]);

        if (Auth::user()->id === 1) {
            Toaster::error(__('profile.main_admin_cannot_delete'));
            return;
        }

        if (User::where('is_admin', true)->count() <= 1) {
            Toaster::error(__('profile.cannot_delete_last_admin'));
            return;
        }

        if (!Hash::check($this->password, Auth::user()->password)) {
            Toaster::error(__('auth.password'));
            return;
        }

        Auth::user()->delete();

        Toaster::success(__('profile.your_account_deleted_successfully'));
        $this->isOpen = false;

        Auth::logout();

        return redirect()->route('auth.login');
    }

    public function render()
    {
        return view('livewire.delete-account');
    }
}
