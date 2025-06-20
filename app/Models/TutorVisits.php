<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TutorVisits extends Model
{
    use HasFactory;

    protected $table = 'tutor_visits';

    protected $fillable = [
        'tutor_students_id',
        'date',
        'observations'
    ];

    public function tutors()
    {
        return $this->belongsTo(TutorStudent::class);
    }
}
