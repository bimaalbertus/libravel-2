<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Publisher extends Model implements HasMedia
{
    use InteractsWithMedia, Searchable;

    use HasFactory;

    protected $table;
    protected $fillable = ['id', 'name', 'image_path'];

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $lastPublisher = Publisher::latest('id')->first();

            if (!$lastPublisher) {
                $nextId = 1;
            } else {
                $lastNumber = (int) substr($lastPublisher->id, 2);
                $nextId = $lastNumber + 1;
            }

            $model->id = 'lc' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
        });

        static::saving(function ($publisher) {
            if (!$publisher->slug) {
                $slug = \Illuminate\Support\Str::slug($publisher->name);

                $originalSlug = $slug;
                $counter = 1;
                while (Publisher::where('slug', $slug)->exists()) {
                    $slug = $originalSlug . '-' . $counter;
                    $counter++;
                }

                $publisher->slug = $slug;
            }
        });
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function getCoverPath()
    {
        return $this->getMedia('publishers')->first() ?? $this->image_path;
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('publishers')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/gif']);
    }

    public function registerAllMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('webp')
            ->width(100)
            ->height(100);
    }

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
