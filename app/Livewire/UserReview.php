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
    }

    public function deleteReview()
    {
        $this->userReview = Review::where('book_id', $this->book_id)
            ->where('user_id', Auth::id())
            ->delete();

        Toaster::success('Review deleted successfully!');
        return redirect()->route('book.detail', ['id' => $this->book_id, 'slug' => $this->book_slug]);
    }

    public function refreshReview()
    {
        $this->loadUserReview();
    }

    public function render()
    {
        $reviews = Review::where('book_id', $this->book_id)->latest()->get();
        return view('livewire.user-review', compact('reviews'));
    }
}
