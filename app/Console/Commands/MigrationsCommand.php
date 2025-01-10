<?php

namespace App\Console\Commands;

use App\Http\Controllers\MigrationController;
use App\Models\Tables;
use Illuminate\Console\Command;

class MigrationsCommand extends Command
{

    protected $signature = 'migrations:tables';
    protected $description = 'Command description';

    
    public function handle()
    {
        $migration = new MigrationController();

        $this->info('Task initiated at: ' . now() . '!');

        foreach(Tables::all() as $table){
            if($table->avance < 100){
                $this->info('Migrando tabla ('.$table->id.'): ' . $table->tabla_origen . ' -> ' . $table->tabla_destino. ', avance: ' . $table->avance);  
                $migration->update($table->id);        
                break;
            }
        }
    }
}
