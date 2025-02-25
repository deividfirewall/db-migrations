<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use ZipArchive;

use function Illuminate\Log\log;

class BackupTableCommand extends Command
{

    protected $signature = 'backup:table {table}';
    protected $description = 'Backup a specific database table';

    public function handle()
    {
        $table = $this->argument('table');
        set_time_limit(45);

        if (strlen($table) > 25) {
            if (strpos($table, 'pignorantes') !== false) {
                $sqlFileName = "bkp_grupo1.sql"; 
                $zipFileName = "bkp_grupo1.zip";
            }else if (strpos($table, 't_boletas') !== false) {
                $sqlFileName = "bkp_grupo2.sql";
                $zipFileName = "bkp_grupo2.zip";                
            }else if (strpos($table, 't_subastas') !== false) {
                $sqlFileName = "bkp_grupo3.sql";
                $zipFileName = "bkp_grupo3.zip";
            }    
        }else{
            //$timestamp = now()->format('Y_m_d_H_i');
            $sqlFileName = "bkp_{$table}.sql"; //"{$table}_bkp_{$timestamp}.sql";
            $zipFileName = "bkp_{$table}.zip"; //"{$table}_bkp_{$timestamp}.zip";
        }
        // Paths
        $sqlFilePath = storage_path("app/public/{$sqlFileName}");
        $zipFilePath = storage_path("app/public/{$zipFileName}");

        // Prepare the `mysqldump` command
        $dbHost = env('DB_HOST', 'mysql');
        $dbPort = env('DB_PORT', '3306');
        $dbUser = env('DB_USERNAME', 'root');
        $dbName = env('DB_DATABASE', 'siemp');
        
        $command = "mysqldump -h {$dbHost} -P {$dbPort} -u {$dbUser} {$dbName} {$table} > {$sqlFilePath}";

        $this->info("Respaldo realizado: {$command}");

        // Execute the command
        exec($command, $output, $returnVar);

        if ($returnVar !== 0) {
            $this->error("Failed to export table '{$table}'.");
            return Command::FAILURE;
        }

        // Compress the SQL file into a ZIP archive
        $zip = new ZipArchive();
        if ($zip->open($zipFilePath, ZipArchive::CREATE) === true) {
            $zip->addFile($sqlFilePath, $sqlFileName); // Add the SQL file to the ZIP
            $zip->close();

            // Remove the original SQL file
            unlink($sqlFilePath);

            $this->info("Table '{$table}' exported and compressed successfully to 'storage/public/{$zipFileName}'.");

            return Command::SUCCESS;
        } else {
            $this->error("Failed to create ZIP file for table '{$table}'.");
            return Command::FAILURE;
        }
    }
}
