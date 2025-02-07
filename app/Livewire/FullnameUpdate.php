<?php

namespace App\Livewire;

use Livewire\Component;
use Masmerise\Toaster\Toaster;

class FullnameUpdate extends Component
{
    public $fullname;

    protected $rules = [
        'fullname' => 'required|string|max:48'
    ];

    public function mount()
    {
        $this->fullname = auth()->user()->fullname;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();

        auth()->user()->update([
            'fullname' => $this->fullname
        ]);

        Toaster::success(__('profile.saved_successfully'));

        return redirect()->route('settings.account');
    }

    public function render()
    {
        return view('livewire.fullname-update');
    }
}
