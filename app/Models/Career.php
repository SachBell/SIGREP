<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;

    protected $table = 'careers';

    protected $fillable = [
        'name',
        'is_dual'
    ];

    protected $casts = [
        'is_dual' => 'boolean',
    ];

    public function teacherProfile()
    {
        return $this->hasMany(TeacherProfile::class, 'career_id');
    }

    public function applicationCalls()
    {
        return $this->hasMany(ApplicationCall::class, 'career_id');
    }

    public function userData()
    {
        return $this->hasMany(UserData::class, 'career_id');
    }

    public function entities()
    {
        return $this->belongsToMany(ReceivingEntity::class, 'career_entities', 'career_id', 'entity_id');
    }
}
