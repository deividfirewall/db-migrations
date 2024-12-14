<?php

namespace Database\Seeders;

use App\Models\AdmSede;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Contracts\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // se eliminan primero las bases de los tenants desde phpmyadmin
        // se ejecutan los siguinetes comandos
        // php artisan migrate:fresh --seed
        // php artisan db:seed --class=DatabaseSeeder
        $this->call([
            SedeSeeder::class,
            MetalesSeeder::class,
            ProductosSeeder::class,
            PrestamosSeeder::class,
            LocalidadesSeeder::class,
            // StatusEmpenioSeeder::class,
            OtrosCatalogosSeeder::class,

            
        ]);
        // User::factory(10)->create();
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
