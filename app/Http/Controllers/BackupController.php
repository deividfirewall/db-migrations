<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class BackupController extends Controller
{
    public function backupTable($tableName)
    {
        $Folder = env('DB_DATABASE_SUC', 'sucursal');

        try {
            $exitCode = Artisan::call('backup:table', [ 'table' => $tableName ]);
            // Obtener la salida del comando
            $output = Artisan::output();

            // Definir ruta y nombre del archivo de log
            $logFile = storage_path('logs/dumpmysql_' . $Folder .  '.log');

            // Guardar la salida en el archivo de log
            file_put_contents($logFile, $output, FILE_APPEND);
            
            if ($exitCode === 0) {
                return redirect()->back()->with('success', "La tabla '{$tableName}' fue exportada exitosamente.");
            } else {
                return redirect()->back()->with('error', "No se pudo exportar la tabla '{$tableName}, {$exitCode}'.");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', "Error al exportar: {$e->getMessage()}");
        }
    }
    
    public function downloadBackup($fileName)
    {
        $Folder = env('DB_DATABASE_SUC', 'sucursal');

        try {
            $filePath = storage_path('app/public/' . $Folder . '/bkp_' . $fileName . '.zip');
            
            if (file_exists($filePath)) {
                return response()->download($filePath); // Storage::download($filePath); //
            } else {
                return redirect()->back()->with('error', "Archivo no encontrado '{$filePath}'.");
                
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al descargar el backup: ' . $e->getMessage());
        }
    }
}
