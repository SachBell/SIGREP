<?php

namespace App\Console\Commands;

use App\Models\ApplicationCalls;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateApplicationStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-application-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualizar el estado de las convocatorias basadas en fechas.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $currentDate = Carbon::now();

    // Desactivar convocatorias que ya han terminado
    ApplicationCalls::where('end_date', '<', $currentDate)
        ->where('status_call', 1)  // Solo si está activa
        ->update(['status_call' => 0]);

    // Activar convocatorias que están en curso
    ApplicationCalls::where('start_date', '<=', $currentDate)
        ->where('end_date', '>=', $currentDate)
        ->where('status_call', 0)  // Solo si está inactiva
        ->update(['status_call' => 1]);

        $this->info('Estados de convocatorias actualizados exitosamente.');
    }
}
