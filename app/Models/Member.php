<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravolt\Avatar\Facade as Avatar;

class Member extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'members';
    protected $fillable = [
        'fullname',
        'username',
        'password',
        'status',
        'gender',
        'major',
        'language'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $guard = 'member';

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
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
}
