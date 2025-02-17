<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{

    use HasFactory;

    protected $table = 'grades';

    protected $fillable = [
        'grade',
    ];

    public function userData() {
        return $this->hasMany(UserData::class, 'id_grade');
    }
}
