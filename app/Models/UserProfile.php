<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $table = 'user_profiles';

    protected $fillable = [
        'name',
        'lastnames',
        'id_card',
        'phone_number',
        'address',
        'neighborhood'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function userData()
    {
        return $this->hasOne(UserData::class, 'profile_id');
    }

    public function tutor()
    {
        return $this->belongsToMany(TeacherProfile::class, 'tutor_students', 'user_profile_id', 'teacher_profile_id');
    }
}
