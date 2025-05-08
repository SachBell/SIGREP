<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationDetails extends Model
{
    use HasFactory;

    const STATUS_PENDIENTE = 'pendiente';
    const STATUS_ACTIVO = 'activo';
    const STATUS_FINALIZADO = 'finalizado';

    protected $table = 'application_details';

    protected $casts = [
        'status_individual' => 'string'
    ];

    protected $fillable = [
        'id_application_calls',
        'id_user_data',
        'id_institutes',
        'status_individual'
    ];

    public function institutes()
    {
        return $this->belongsTo(ReceivinEntity::class, 'id_institutes');
    }

    public function applicationCalls()
    {
        return $this->belongsTo(ApplicationCalls::class, 'id_application_calls');
    }

    public function userData()
    {
        return $this->belongsTo(UserData::class, 'id_user_data');
    }
}
