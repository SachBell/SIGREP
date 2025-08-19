<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use ZipArchive;

use function Laravel\Prompts\error;

class UpdateApplication extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualizar la aplicación a la última versión';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Iniciando respaldo de la base de datos...");
        Artisan::call('backup:run', ['--only-db' => true]);
        $this->info("Respaldo completado ✅");

        $zipUrl = 'https://github.com/SachBell/SIGREP/archive/refs/tags/SGPP-v3.5.4-alpha.zip';
        $tempZip = storage_path('app/update.zip');
        $tempDir = storage_path('app/update-temp');

        $this->info("Descargando actualización...");
        file_put_contents($tempZip, fopen($zipUrl, 'r'));
        $this->info("ZIP descargado ✅");

        $this->info("Descomprimiendo actualización...");
        $zip = new ZipArchive;
        if ($zip->open($tempZip) === true) {
            $zip->extractTo($tempDir);
            $zip->close();
            $this->info("Descompresión completada ✅");
        } else {
            $this->error("Error al descomprimir el ZIP");
            return 1;
        }

        $this->info("Actualizando archivos...");
        $source = $tempDir . '/repositorio-main';
        File::copyDirectory($source, base_path(), true);
        $this->info("Archivos actualizados ✅");

        $this->info("Limpiando archivos temporales...");
        File::delete($tempZip);
        File::deleteDirectory($tempDir);
        $this->info("Limpieza completada ✅");

        $this->info("¡Actualización finalizada!");
        return 0;
    }
}
