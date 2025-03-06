<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Logout extends Component
{
    public $isLoading = false;

    public function logout()
    {
        $this->isLoading = true;
        sleep(1);

        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.logout');
    }
}
