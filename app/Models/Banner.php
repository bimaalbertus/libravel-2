<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Banner extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title',
        'content',
        'image',
        'is_active',
        'href',
        'start_date',
        'end_date',
        'image_only'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'image_only' => 'boolean',
        'start_date' => 'datetime',
        'end_date' => 'datetime'
    ];

    public function isImageOnly(): bool
    {
        return $this->image_only;
    }

    public function isActive(): bool
    {
        return $this->is_active;
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('start_date')
                    ->orWhere('start_date', '<=', now())
                    ->where(function ($q2) {
                        $q2->whereNull('end_date')
                            ->orWhere('end_date', '>=', now());
                    });
            });
    }
}
