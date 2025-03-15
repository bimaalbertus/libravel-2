<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\UserReview as Review;
use Illuminate\Support\Facades\Auth;
use Masmerise\Toaster\Toaster;

class UserReview extends Component
{
    public $ratingOpen = false;
    public $book_id;
    public $book_slug;
    public $userReview;
    public $deleteModal = false;
    public $hidden;

    protected $listeners = ['reviewAdded' => 'refreshReview'];

    public function mount()
    {
        $this->loadUserReview();
    }

    public function loadUserReview()
    {
        $this->userReview = Review::where('book_id', $this->book_id)
            ->where('user_id', Auth::id())
            ->first();

        $this->hidden = $this->userReview ? !$this->userReview->isVisible() : false;
    }

    public function deleteReview()
    {
        if (Review::where('book_id', $this->book_id)
            ->where('user_id', Auth::id())
            ->first()
        ) {
            $this->userReview = Review::where('book_id', $this->book_id)
                ->where('user_id', Auth::id())
                ->delete();

            $this->js('window.location.reload()');
            Toaster::success(__('review.review_deleted'));
        }
    }

    public function refreshReview()
    {
        $this->loadUserReview();
    }

    public function render()
    {
        $reviews = Review::visible()->where('book_id', $this->book_id)->latest()->get();
        return view('livewire.user-review', compact('reviews'));
    }
}
