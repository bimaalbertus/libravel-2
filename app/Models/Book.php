<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $table;
    protected $fillable = ['title', 'synopsis', 'language', 'cover_path', 'page_count', 'release_date', 'is_fiction'];
}
