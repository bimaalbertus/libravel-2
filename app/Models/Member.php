<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table;
    protected $fillable = [
        'fullname',
        'username',
        'password',
        'status',
        'gender',
        'major',
    ];

    public function majors()
    {
        return $this->belongsTo(Major::class, 'major', 'abbreviation');
    }
}
