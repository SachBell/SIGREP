<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalGrade extends Model
{
    use HasFactory;

    protected $table = 'final_grades';

    protected $fillable = [
        'tutor_students_id',
        'grade',
        'observations'
    ];

    public function tutorStudent()
    {
        return $this->belongsTo(TutorStudent::class, 'tutor_students_id');
    }
}
