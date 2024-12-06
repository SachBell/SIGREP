<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;

    protected $table = 'semesters';

    protected $fillable = [
        'semester'
    ];

    // Relación con UserData
    public function userData() {
        return $this->hasMany(UserData::class, 'id_semester');
    }
}
