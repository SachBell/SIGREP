<?php

namespace App\Models;

use App\Traits\HasCareerScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherProfile extends Model
{
    use HasFactory, HasCareerScope;

    protected $table = 'teacher_profiles';

    protected $fillable = [
        'users_id',
        'name',
        'lastnames',
        'career_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function career()
    {
        return $this->belongsTo(Career::class, 'career_id');
    }

    public function tutor()
    {
        return $this->hasMany(TutorStudent::class, 'teacher_profile_id');
    }

    public function students()
    {
        return $this->belongsToMany(
            UserProfile::class,
            'tutor_students',
            'teacher_profile_id',
            'user_profile_id'
        );
    }
}
