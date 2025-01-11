<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationDetails extends Model
{
    use HasFactory;

    protected $table = 'application_details';

    protected $fillable = [
        'id_application_calls',
        'id_user_data',
        'id_institutes',
        'status_individual'
    ];

    public function institutes()
    {
        return $this->belongsTo(Institute::class, 'id_institutes', 'id');
    }

    public function applicationCalls()
    {
        return $this->belongsTo(ApplicationCalls::class, 'id_application_calls', 'id');
    }

    public function userData()
    {
        return $this->belongsTo(UserData::class, 'id_user_data', 'id');
    }
}
