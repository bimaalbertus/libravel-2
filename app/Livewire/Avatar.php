<?php

namespace App\Livewire;

use App\Models\Avatar as AvatarModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Masmerise\Toaster\Toaster;

class Avatar extends Component
{
    use WithFileUploads;

    public $avatars;
    public $selectedAvatarId;
    public $openAvatar = false;
    public $newAvatar;

    public function mount()
    {
        $this->avatars = AvatarModel::all();
        $this->selectedAvatarId = Auth::user()->avatar_id;
    }

    public function saveAvatar()
    {
        /**  @var User $user */
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
