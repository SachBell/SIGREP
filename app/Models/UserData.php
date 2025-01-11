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
        'daytrip',
    ];

    public function applicationDetails()
    {
        return $this->hasMany(ApplicationDetails::class, 'id_user_data');
    }

    public function grades()
    {
        return $this->belongsTo(Grade::class, 'id_grade');
    }

    public function semesters()
    {
        return $this->belongsTo(Semester::class, 'id_semester');
    }
}
