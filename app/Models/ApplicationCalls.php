<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationCalls extends Model
{
    use HasFactory;

    protected $table = 'application_calls';

    protected $fillable = [
        'application_title',
        'start_date',
        'end_date',
        'status_call',
    ];

    public function isActive(): bool
    {
        $currentDate = now();
        return $this->start_date <= $currentDate && $this->end_date >= $currentDate;
    }

    public function applicationCalls()
    {
        return $this->hasMany(ApplicationDetails::class, 'id_application_calls');
    }
}
