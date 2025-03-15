<?php

namespace App\Livewire;

use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Bio extends Component
{
    public $bio;

    protected $rules = [
        'bio' => 'nullable|max:500'
    ];

    public function mount()
    {
        $this->bio = auth()->user()->bio;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();

        auth()->user()->update([
            'bio' => $this->bio
        ]);

        Toaster::success(__('profile.bio.success'));
        return redirect()->route('profile.index', auth()->user()->username);
    }

    public function render()
    {
        return view('livewire.bio');
    }
}
