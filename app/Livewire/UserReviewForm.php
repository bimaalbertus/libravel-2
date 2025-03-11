<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\UserReview as Review;
use Illuminate\Support\Facades\Auth;
use Masmerise\Toaster\Toaster;

class UserReviewForm extends Component
{
    public $bookId;
    public $bookSlug;
    public $rating = 0;
    public $reviewText = '';
    public $savedRating = 0;
    public $savedReview = '';
    public $hasReviewed = false;

    public function mount($bookId)
    {
        $this->bookId = $bookId;
        $this->loadExistingReview();
    }

    protected function loadExistingReview()
    {
        if (Auth::check()) {
            $review = Review::where('user_id', Auth::id())
                ->where('book_id', $this->bookId)
                ->first();

            if ($review) {
                $this->rating = $this->savedRating = $review->rating;
                $this->reviewText = $this->savedReview = $review->review_text;
                $this->hasReviewed = true;
            }
        }
    }

    public function saveRating()
    {
        $this->validate([
            'rating' => 'required|numeric|min:0.5|max:5',
            'reviewText' => 'min:3|max:1000',
        ]);

        if (Auth::check()) {
            Review::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'book_id' => $this->bookId,
                ],
                [
                    'rating' => $this->rating,
                    'review_text' => $this->reviewText,
                ]
            );

            $this->savedRating = $this->rating;
            $this->savedReview = $this->reviewText;
            $this->hasReviewed = true;

            Toaster::success(__('review.review_saved'));
            return redirect()->route('book.detail', ['id' => $this->bookId, 'slug' => $this->bookSlug]);
        }
    }

    public function updateRating($value)
    {
        $this->rating = $value;
    }

    public function render()
    {
        return view('livewire.user-review-form');
    }
}
