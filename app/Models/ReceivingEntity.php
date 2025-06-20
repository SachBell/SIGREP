<?php

namespace App\Models;

use App\Traits\HasCareerScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceivingEntity extends Model
{
    use HasFactory, HasCareerScope;

    protected $table = 'receiving_entities';

    protected $fillable = [
        'name',
        'address',
        'user_limit',
        'productive_sector',
        'principal_id',
        'observations',
        'convenant_start_date',
        'convenant_end_date',
    ];

    public function applicationDetail()
    {
        return $this->hasMany(ApplicationDetail::class, 'receiving_entity_id');
    }

    public function principalData()
    {
        return $this->belongsTo(PrincipalData::class, 'principal_data_id');
    }

    public function careers()
    {
        return $this->belongsToMany(Career::class, 'career_entities', 'entity_id', 'career_id');
    }
}
