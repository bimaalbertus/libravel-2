<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class UserReview extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'book_id', 'review_text', 'rating', 'is_visible'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function isVisible(): bool
    {
        return $this->is_visible;
    }

    public function scopeVisible(Builder $query): void
    {
        $query->where('is_visible', true);
    }
}
