<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    use HasFactory;

    protected $table = 'user_data';

    protected $fillable = [
        'cei',
        'name',
        'lastname',
        'phone_number',
        'email',
        'address',
        'neighborhood',
        'id_semester',
        'id_grade',
        'id_institute',
        'daytrip',
    ];

    public function grades() {
        return $this->belongsTo(Grade::class, 'id_grade');
    }

    public function semesters() {
        return $this->belongsTo(Semester::class, 'id_semester');
    }

    public function institutes() {
        return $this->belongsTo(Institucion::class, 'id_institute');
    }
}
