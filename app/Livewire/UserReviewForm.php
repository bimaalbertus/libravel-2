<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\UserReview as Review;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Masmerise\Toaster\Toaster;
use Filament\Forms;

class UserReviewForm extends Component implements HasForms
{
    use InteractsWithForms;

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
        $this->form->fill(['reviewText' => $this->reviewText]);
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

    public function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\RichEditor::make('reviewText')
                    ->label(ucfirst(__('review.your_review')))
                    ->disableToolbarButtons(['attachFiles', 'h2', 'h3', 'codeBlock', 'link', 'blockquote'])
                    ->maxLength(5000)
                    ->extraAttributes(['class' => 'max-h-96']),
            ])
            ->statePath('reviewText');
    }

    public function saveRating()
    {
        try {
            $this->validate([
                'rating' => 'required|numeric|min:0.5|max:5',
            ]);

            if (Auth::check()) {
                $reviewTextHtml = $this->form->getState()['reviewText'];
                Review::updateOrCreate(
                    [
                        'user_id' => Auth::id(),
                        'book_id' => $this->bookId,
                    ],
                    [
                        'rating' => $this->rating,
                        'review_text' => $reviewTextHtml,
                    ]
                );

                $this->savedRating = $this->rating;
                $this->savedReview = $this->reviewText;
                $this->hasReviewed = true;

                Toaster::success(__('review.review_saved'));
                return redirect()->route('book.detail', ['id' => $this->bookId, 'slug' => $this->bookSlug]);
            }
        } catch (ValidationException $e) {
            foreach ($e->errors() as $fieldErrors) {
                foreach ($fieldErrors as $error) {
                    Toaster::error($error);
                }
            }
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
