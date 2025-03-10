<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravolt\Avatar\Facade as Avatar;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Filament\Models\Contracts\HasName;

class User extends Authenticatable implements FilamentUser, HasName
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;
    use \TomatoPHP\FilamentLanguageSwitcher\Traits\InteractsWithLanguages;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'fullname',
        'username',
        'password',
        'status',
        'gender',
        'major',
        'language',
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
        $name = !empty($this->fullname) ? $this->fullname : $this->username;

        return Avatar::create(strtoupper($name))
            ->setDimension($size, $size)
            ->setBackground('#1f1f1f')
            ->setFontSize($size * 0.4)
            ->setFontFamily('Product Sans')
            ->setShape($shape)
            ->toSvg();
    }

    public function majors()
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
}
