<?php

namespace App\Livewire;

use App\Models\Avatar as Model;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Avatar extends Component
{
    public $avatars;
    public $selectedAvatarId;
    public $avatarOpen = false;

    public function mount()
    {
        $this->avatars = Model::all();
        $this->selectedAvatarId = Auth::user()->avatar_id;
    }

    public function saveAvatar()
    {
        $user = Auth::user();
        $user->update(['avatar_id' => $this->selectedAvatarId]);
        Toaster::success(__('profile.avatar.avatar_success'));

        return redirect()->route('profile.index', $user->username);
    }

    public function render()
    {
        return view('livewire.avatar');
    }
}
