<?php

namespace App\Models;

use App\Traits\HasCareerScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    use HasFactory, HasCareerScope;

    protected $table = 'user_data';

    protected $fillable = [
        'profile_id',
        'career_id',
        'id_card',
        'semester_id',
        'grade_id',
        'daytrip',
    ];

    public function profiles()
    {
        return $this->belongsTo(UserProfile::class, 'profile_id');
    }

    public function semesters()
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }

    public function grades()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function careers()
    {
        return $this->belongsTo(Career::class, 'career_id');
    }

    public function applicationDetail()
    {
        return $this->hasOne(ApplicationDetail::class, 'user_data_id');
    }

    public function receivingEntity()
    {
        return $this->hasOneThrough(
            ReceivingEntity::class,
            ApplicationDetail::class,
            'user_data_id',
            'id',
            'id',
            'receiving_entity_id'
        );
    }
}
