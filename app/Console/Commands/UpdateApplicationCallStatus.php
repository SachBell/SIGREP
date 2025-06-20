<?php

namespace App\Console\Commands;

use App\Models\ApplicationCall;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateApplicationCallStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calls:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualiza automáticamente el estado de las convocatorias segun su fecha actual.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();

        ApplicationCall::all()->each(function ($app) use ($now) {
            if ($app->start_date <= $now && $app->end_date >= $now) {
                $app->status = 'Activo';
            } elseif ($app->end_date < $now) {
                $app->status = 'Finalizado';
            }

            $app->save();
        });

        $this->info('Estados de convocatorias actualizados correctamente.');
    }
}
