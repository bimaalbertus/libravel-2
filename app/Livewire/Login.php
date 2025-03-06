<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Masmerise\Toaster\Toaster;

class Login extends Component
{
    public $username;
    public $password;

    public function submit()
    {
        $credentials = $this->validate([
            'username' => 'required|string|min:3|max:32',
            'password' => 'required|string|min:8',
        ]);

        if (Auth::attempt($credentials)) {
            session()->regenerate();

            Toaster::success(__('profile.login_success'));
            return redirect('/');
        }

        throw ValidationException::withMessages([
            'username' => __('auth.failed'),
        ]);
    }

    public function render()
    {
        return view('livewire.login');
    }
}
