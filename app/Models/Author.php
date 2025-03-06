<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Author extends Model implements HasMedia
{
    use InteractsWithMedia, Searchable;

    protected $table;
    protected $fillable = ['id', 'fullname', 'image_path', 'birthdate', 'deathdate', 'bio'];

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $lastAuthor = Author::latest('id')->first();

            if (!$lastAuthor) {
                $nextId = 1;
            } else {
                $lastNumber = (int) substr($lastAuthor->id, 2);
                $nextId = $lastNumber + 1;
            }

            $model->id = 'lp' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
        });

        static::saving(function ($author) {
            if (!$author->slug) {
                $slug = \Illuminate\Support\Str::slug($author->fullname);

                $originalSlug = $slug;
                $counter = 1;
                while (Author::where('slug', $slug)->exists()) {
                    $slug = $originalSlug . '-' . $counter;
                    $counter++;
                }

                $author->slug = $slug;
            }
        });
    }

    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_author');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('authors')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/gif']);
    }

    public function registerAllMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('webp')
            ->width(100)
            ->height(100);
    }

    public function getCoverPath($type = 'single')
    {
        $spatieUrl = $this->getFirstMedia('authors') ? $this->getFirstMedia('authors')->getUrl() : null;
        $imagePath = $this->image_path;

        if ($type === 'all') {
            return [
                'spatie' => $spatieUrl,
                'image_path' => $imagePath
            ];
        }

        return $spatieUrl ?: $imagePath;
    }

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'fullname' => $this->fullname,
            'bio' => $this->bio,
        ];
    }
}
