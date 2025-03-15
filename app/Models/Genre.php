<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class Genre extends Model
{
    use HasFactory;

    protected $table;
    protected $fillable = ['key', 'icon'];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_genre', 'genre_id', 'book_id');
    }
}
