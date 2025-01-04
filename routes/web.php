<?php

use App\Http\Controllers\BackupController;
use App\Http\Controllers\CatalogsController;
use App\Http\Controllers\MigrationController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index']);

Route::resource('migrations', MigrationController::class);

Route::resource('catalogs', CatalogsController::class);

Route::get('/backup/{table}', [BackupController::class, 'backupTable'])->name('backup.table');
Route::get('/backup/download/{fileName}', [BackupController::class, 'downloadBackup'])->name('backup.download');

// Cuando se cambia la configuración de la base de datos(en el archivo .env), se debe reiniciar el contenedor de Docker de la siguiente manera:
// docker system prune -f
// sail artisan config:cache
// ./vendor/bin/sail down -v
// ./vendor/bin/sail up -d --build

//  Entrar al contenedor de mysql
// ./vendor/bin/sail exec mysql bash
// bash-4.4# mysql -u root -p

