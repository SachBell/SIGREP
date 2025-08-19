<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use ZipArchive;

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

        $this->info("Consultando la última versión en GitHub...");
        $response = Http::get('https://api.github.com/repos/SachBell/SIGREP/releases/latest');

        if ($response->failed()) {
            $this->error("No se pudo obtener la última versión de GitHub");
            return 1;
        }

        $release = $response->json();
        $tagName = $release['tag_name'] ?? null;

        if (!$tagName) {
            $this->error("No se encontró el tag_name en la última release");
            return 1;
        }

        preg_match('/v?(\d+(\.\d+)*(-[a-zA-Z0-9]+)?)/', $tagName, $matches);
        $newVersion = $matches[1] ?? null;

        if (!$newVersion) {
            $this->error("No se pudo extraer la versión del tag: {$tagName}");
            return 1;
        }

        $zipUrl = "https://github.com/SachBell/SIGREP/archive/refs/tags/{$tagName}.zip";
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
        $folders = glob($tempDir . '/*', GLOB_ONLYDIR);
        $source = $folders[0] ?? null;

        if (!$source) {
            throw new Exception("No se encontró la carpeta dentro del ZIP");
        }

        File::copyDirectory($source, base_path(), true);
        $this->info("Archivos actualizados ✅");

        $configPath = config_path('version.php');
        $configContent = File::get($configPath);

        $updatedContent = preg_replace(
            "/('app'\s*=>\s*)'[^']*'/",
            "$1'{$newVersion}'",
            $configContent
        );

        File::put($configPath, $updatedContent);
        $this->info("Versión actualizada en config/app.php ✅ ({$newVersion})");

        $this->info("Limpiando archivos temporales...");
        File::delete($tempZip);
        File::deleteDirectory($tempDir);

        $this->info("Limpieza completada ✅");

        $this->info("Ejecutando migraciones y seeders...");
        Artisan::call('migrate:refresh', ['--seed' => true]);
        $this->info(Artisan::output());

        $this->info("Limpiando cache y optimizaciones...");
        Artisan::call('optimize:clear');
        $this->info(Artisan::output());

        $this->info("¡Actualización finalizada!");

        $this->info("Ejecutando migraciones y seeders...");
        Artisan::call('migrate:refresh', ['--seed' => true]);
        $this->info(Artisan::output());

        $this->info("Limpiando cache y optimizaciones...");
        Artisan::call('optimize:clear');
        $this->info(Artisan::output());
        return 0;
    }
}
