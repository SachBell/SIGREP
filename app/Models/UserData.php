<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class UserData extends Model
{
    use HasFactory, Searchable;

    protected $table = 'user_data';

    protected $fillable = [
        'id_user',
        'id_card',
        'name',
        'lastname',
        'phone_number',
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

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function toSearchableArray()
    {

        return [
            'id_card' => $this->id_card,
            'name' => $this->name,
            'lastname' => $this->lastname,
            'address' => $this->address,
        ];
    }
}
