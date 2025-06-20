<?php

namespace App\Models;

use App\Traits\HasCareerScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationDetail extends Model
{
    use HasFactory, HasCareerScope;

    protected $table = 'application_details';

    protected $fillable = [
        'application_calls_id',
        'user_data_id',
        'receiving_entity_id',
        'status_individual',
    ];

    public function applicationCalls()
    {
        return $this->belongsTo(ApplicationCall::class, 'application_calls_id');
    }

    public function userData()
    {
        return $this->belongsTo(UserData::class, 'user_data_id');
    }

    public function receivingEntities()
    {
        return $this->belongsTo(ReceivingEntity::class, 'receiving_entity_id');
    }
}
