<?php

namespace App\Models;

use App\Traits\HasCareerScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TutorStudent extends Model
{
    use HasFactory, HasCareerScope;

    protected $table = 'tutor_students';

    protected $fillable = [
        'user_profile_id',
        'teacher_profile_id',
    ];

    public function userData()
    {
        return $this->belongsTo(UserProfile::class, 'user_profile_id');
    }

    public function profiles()
    {
        return $this->belongsTo(TeacherProfile::class, 'teacher_profile_id');
    }

    public function visits()
    {
        return $this->hasMany(TutorVisits::class, 'tutor_students_id');
    }
}
