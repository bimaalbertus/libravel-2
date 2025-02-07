<?php

namespace App\Livewire;

use Livewire\Component;
use Masmerise\Toaster\Toaster;

class UsernameUpdate extends Component
{
    public $username;

    protected $rules = [
        'username' => 'required|string|max:32'
    ];

    public function mount()
    {
        $this->username = auth()->user()->username;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();

        $existingUser = \App\Models\User::where('username', $this->username)
            ->where('id', '!=', auth()->user()->id)
            ->first();

        if ($existingUser) {
            Toaster::error(__('profile.username_exists'));
            return;
        }

        auth()->user()->update([
            'username' => $this->username
        ]);

        Toaster::success(__('profile.saved_successfully'));

        return redirect()->route('settings.account');
    }

    public function render()
    {
        return view('livewire.username-update');
    }
}
