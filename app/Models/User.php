<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Filament\Models\Contracts\HasName;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use TomatoPHP\FilamentLanguageSwitcher\Traits\InteractsWithLanguages;

class User extends Authenticatable implements FilamentUser, HasName, HasMedia
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, InteractsWithLanguages, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'fullname',
        'username',
        'password',
        'bio',
        'status',
        'gender',
        'major',
        'language',
        'avatar_id',
        'delete_request_at',
        'is_admin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $guard_name = 'web';

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }

    public function getUsernameAttribute($value)
    {
        return '@' . $value;
    }

    public function setUsernameAttribute($value)
    {
        if (substr($value, 0, 1) === '@') {
            $this->attributes['username'] = substr($value, 1);
        } else {
            $this->attributes['username'] = $value;
        }
    }

    public function isAdmin(): bool
    {
        return $this->is_admin;
    }


    public function canAccessPanel(Panel $panel): bool
    {
        return $this->isAdmin();
    }

    public function getFilamentName(): string
    {
        return $this->fullname ?? $this->username;
    }

    public function getAvatar($size = 100, $shape = 'square')
    {
        if ($this->avatar && $this->avatar->getFirstMediaUrl('avatars')) {
            return $this->avatar->getFirstMediaUrl('avatars');
        }

        if ($this->getFirstMediaUrl('user.avatar')) {
            return $this->getFirstMediaUrl('user.avatar');
        }

        $name = !empty($this->fullname) ? $this->fullname : $this->username;

        return \Laravolt\Avatar\Facade::create(strtoupper($name))
            ->setDimension($size, $size)
            ->setBackground('#1f1f1f')
            ->setFontSize($size * 0.4)
            ->setFontFamily('Product Sans')
            ->setShape($shape)
            ->toSvg();
    }

    public function getMediaBasePath(Media $media): string
    {
        return 'user/avatar';
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('user/avatar')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png']);
    }

    public function registerAllMediaConversions(): void
    {
        $this->addMediaConversion('webp')
            ->width(250)
            ->height(250);
    }

    public function major()
    {
        return $this->belongsTo(Major::class, 'major', 'abbreviation');
    }

    public function messages()
    {
        return $this->hasMany(UserMessage::class);
    }

    public function latestMessage()
    {
        return $this->hasOne(UserMessage::class)->latestOfMany();
    }

    public function readLaters()
    {
        return $this->belongsToMany(Book::class, 'read_laters', 'user_id', 'book_id');
    }

    public function reviews()
    {
        return $this->hasMany(UserReview::class);
    }

    public function avatar()
    {
        return $this->belongsTo(Avatar::class);
    }

    public function downloads()
    {
        return $this->hasMany(Download::class);
    }
}
