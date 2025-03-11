<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Collection extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, Searchable;

    protected $table = 'collections';
    protected $fillable = [
        'title',
        'description',
        'image_path',
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_collections');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('book_collection')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/gif']);
    }

    public function getCoverPath($type = 'single')
    {
        $spatieUrl = $this->getFirstMedia('book_collection') ? $this->getFirstMedia('book_collection')->getUrl() : null;
        $imagePath = $this->image_path;

        if ($type === 'all') {
            return [
                'spatie' => $spatieUrl,
                'image_path' => $imagePath
            ];
        }

        return $spatieUrl ?: $imagePath;
    }


    public function registerAllMediaConversions(): void
    {
        $this->addMediaConversion('webp')
            ->width(200)
            ->height(200);
    }

    public function toSearchableArray()
    {
        return [
            'id'   => $this->id,
            'title' => $this->title,
            'description' => $this->description,
        ];
    }
}
