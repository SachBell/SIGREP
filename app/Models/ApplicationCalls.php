<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationCalls extends Model
{
    use HasFactory;

    protected $table = 'application_calls';

    protected $fillable = [
        'start_date',
        'end_date',
        'status',
    ];

    public function applicationCalls()
    {
        return $this->hasMany(ApplicationDetails::class, 'id_application_calls');
    }
}
