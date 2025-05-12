<?php

use App\Console\Commands\MigrationsCommand;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\File;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

/* 
Schedule::command(MigrationsCommand::class)
        // ->everyMinute()
        ->everyFiveMinutes()
        ->appendOutputTo('./storage/logs/migrations.log')
        ->after(function () {
            $completionTime = now()->format('Y-m-d H:i:s');
            $logMessage = "\nTask completed at: " . $completionTime . "\n" . str_repeat('-', 50) . "\n";
            
            File::append(
                storage_path('logs/migrations.log'),
                $logMessage
            );
        });
        /** */