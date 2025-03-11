<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;

    protected $primaryKey = 'abbreviation';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['name', 'abbreviation'];

    public function users()
    {
        return $this->hasMany(User::class, 'major', 'abbreviation');
    }
}
