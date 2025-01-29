<?php

namespace App\Models;

use Carbon\Carbon;
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

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Se ejecuta automáticamente al inicializar el modelo
        static::updating(function ($applicationCall) {
            $currentDate = Carbon::now();

            // Desactivar convocatorias cuya fecha final ya ha pasado
            if ($applicationCall->end_date < $currentDate && $applicationCall->status_call == 1) {
                $applicationCall->status_call = 0;
                $applicationCall->save();
            }

            // Activar convocatorias que estén dentro del rango de fecha
            if ($applicationCall->start_date <= $currentDate && $applicationCall->end_date >= $currentDate && $applicationCall->status_call == 0) {
                $applicationCall->status_call = 1;
                $applicationCall->save();
            }
        });
    }

    public function isActive(): bool
    {
        $currentDate = now();
        return $this->start_date <= $currentDate && $this->end_date >= $currentDate;

        // If need it Cron Jobs with Kernel Console uncommanted this part
        // The command has begining created and configured
        //
        // $currentDate = now();
        // $isActive = $this->start_date <= $currentDate && $this->end_date >= $currentDate;
        //
        // if ($isActive && $this->status_call !== 1) {
        //     $this->update(['status_call' => 1]);
        // } elseif (!$isActive && $this->status_call !== 0) {
        //     $this->update(['status_call' => 0]);
        // }
        // return $isActive;
    }

    public function applicationCalls()
    {
        return $this->hasMany(ApplicationDetails::class, 'id_application_calls');
    }
}
