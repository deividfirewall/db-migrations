<?php

namespace Database\Seeders;

use App\Models\CatStatusEmpenio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OtrosCatalogosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $operaciones = [
            ['id' => 1, 'operacion' => 'Empeño'],
            ['id' => 2, 'operacion' => 'Refrendo'],
            ['id' => 3, 'operacion' => 'Abono'],
            ['id' => 4, 'operacion' => 'Reposición de boleta'],
            ['id' => 5, 'operacion' => 'Desempeño'],
        ];
        DB::table('cat_operacion_tipos')->insert($operaciones);


        $CatStatusDemasia = [
            ['id' => 1, 'status' => 'Pagada', 'simbolo' => 'P'],
            ['id' => 2, 'status' => 'Demasia nula o en cero', 'simbolo'=> '0'],
            ['id' => 3, 'status' => 'Demasia vigente', 'simbolo'=> 'V'],
            ['id' => 4, 'status' => 'Demasia caduca', 'simbolo' => 'C'],
        ];
        DB::table('cat_status_demasias')->insert($CatStatusDemasia);

        $CatStatusSubasta = [
            ['id' => 1, 'status' => 'activo'],
            ['id' => 2, 'status' => 'vendido'],
            ['id' => 3, 'status' => 'vitrina'],
            ['id' => 4, 'status' => 'regreso a depositaría'],
            ['id' => 6, 'status' => 'desempeño en subasta'],
        ];
        DB::table('cat_status_subastas')->insert($CatStatusSubasta);

        CatStatusEmpenio::create([
            ['id' => 1, 'status_empenio' => 'Depositaria'],
            ['id' => 2, 'status_empenio' => 'Periodo de Gracia'],
            ['id' => 3, 'status_empenio' => 'Almoneda'],
            ['id' => 4, 'status_empenio' => 'Subasta'],
            ['id' => 5, 'status_empenio' => 'Desempeño'],
            ['id' => 6, 'status_empenio' => 'Pago demasia'],
            ['id' => 7, 'status_empenio' => 'Vitrina'],
            ['id' => 8, 'status_empenio' => 'Vendido Subasta'],
            ['id' => 9, 'status_empenio' => 'Baja'],
            ['id' => 10, 'status_empenio' => 'Resguardo'],
            ['id' => 11, 'status_empenio' => 'Vendido Vitrina'],
            ['id' => 12, 'status_empenio' => 'Siniestro Dep.'],
            ['id' => 13, 'status_empenio' => 'Siniestro Alm.'],
            ['id' => 14, 'status_empenio' => 'Proceso Jurídico'],
            ['id' => 15, 'status_empenio' => 'Venta Parcial'],
            ['id' => 16, 'status_empenio' => 'Bloqueado'],
            ['id' => 17, 'status_empenio' => 'Espera'],
        ]);
    }
}
