<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;

class BackupController extends Controller
{
    public function backupTable($tableName)
    {
        try {
            $exitCode = Artisan::call('backup:table', [
                'table' => $tableName
            ]);
            
            if ($exitCode === 0) {
                return redirect()->back()->with('success', "La tabla '{$tableName}' fue exportada exitosamente.");
            } else {
                return redirect()->back()->with('error', "No se pudo exportar la tabla '{$tableName}'.");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', "Error al exportar: {$e->getMessage()}");
        }
    }
    
    public function downloadBackup($fileName)
    {
        try {
            $filePath = storage_path('app/public/bkp_' . $fileName.'.zip');
            
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
