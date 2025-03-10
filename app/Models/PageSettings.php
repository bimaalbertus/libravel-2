<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageSettings extends Model
{
    use HasFactory;

    protected $table = 'page_settings';
    protected $fillable = ['key', 'value'];

    protected $casts = [
        'value' => 'boolean',
    ];
}
