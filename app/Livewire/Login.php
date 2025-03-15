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
        try {
            $credentials = $this->validate([
                'username' => 'required|string|min:3|max:32',
                'password' => 'required|string|min:8',
            ]);

            if (Auth::attempt($credentials)) {
                session()->regenerate();
                $locale = app()->getLocale();

                /** @var User $user */
                $user = Auth::user();
                $user->update(['language' => $locale]);

                Toaster::success(__('profile.login_success'));
                return redirect('/');
            } else {
                Toaster::error(__('auth.failed'));
                return;
            }
        } catch (ValidationException $e) {
            foreach ($e->errors() as $fieldErrors) {
                foreach ($fieldErrors as $error) {
                    Toaster::error($error);
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.login');
    }
}
