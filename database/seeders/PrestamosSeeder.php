<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrestamosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('cat_prestamo_tipos')->insert([
            [ 'id' => 15, 'ref' => 'TRAD',  'nombre' => '12 SEMANAS ( JOYERIA, ORO )',       'tipo_empenio' => 1, 'interes_semanal' => 1,    'plazos' => 12, 'dias_plazos' => 7, 'dias_gracia' => 15, 'porcentaje_max' => 80, 'porcentaje_min' => 20, 'resguardo' => 7 ],
            [ 'id' => 17, 'ref' => 'VAR',   'nombre' => '12 SEMANAS ( - OTROS PROD/GTIAS )', 'tipo_empenio' => 2, 'interes_semanal' => 1,    'plazos' => 12, 'dias_plazos' => 7, 'dias_gracia' => 15, 'porcentaje_max' => 75, 'porcentaje_min' => 20, 'resguardo' => 7 ],
            [ 'id' => 18, 'ref' => 'MAXP',  'nombre' => '4 SEMANAS ( MAXP )',                'tipo_empenio' => 1, 'interes_semanal' => 1.2,  'plazos' => 4,  'dias_plazos' => 7, 'dias_gracia' => 15, 'porcentaje_max' => 95, 'porcentaje_min' => 76, 'resguardo' => 6 ],
            [ 'id' => 19, 'ref' => 'MAXP',  'nombre' => '4 SEMANAS (MAXP)',                  'tipo_empenio' => 2, 'interes_semanal' => 1.25, 'plazos' => 4,  'dias_plazos' => 7, 'dias_gracia' => 15, 'porcentaje_max' => 70, 'porcentaje_min' => 20, 'resguardo' => 7 ],
            [ 'id' => 20, 'ref' => 'TRAD',  'nombre' => '12 SEMANAS',                        'tipo_empenio' => 1, 'interes_semanal' => 1,    'plazos' => 12, 'dias_plazos' => 7, 'dias_gracia' => 30, 'porcentaje_max' => 80, 'porcentaje_min' => 20, 'resguardo' => 7 ],
            [ 'id' => 21, 'ref' => 'VAR',   'nombre' => '4 SEMANAS',                         'tipo_empenio' => 2, 'interes_semanal' => 1,    'plazos' => 4,  'dias_plazos' => 7, 'dias_gracia' => 30, 'porcentaje_max' => 65, 'porcentaje_min' => 20, 'resguardo' => 6 ],
            [ 'id' => 22, 'ref' => 'ESP',   'nombre' => 'no lo uses 12 SEMANAS (0.7%)',      'tipo_empenio' => 1, 'interes_semanal' => 0.7,  'plazos' => 12, 'dias_plazos' => 7, 'dias_gracia' => 15, 'porcentaje_max' => 75, 'porcentaje_min' => 20, 'resguardo' => 7 ],
            [ 'id' => 23, 'ref' => 'ESP',   'nombre' => 'no lo uses 4 SEMANAS (0.9%)',       'tipo_empenio' => 1, 'interes_semanal' => 0.9,  'plazos' => 4,  'dias_plazos' => 7, 'dias_gracia' => 15, 'porcentaje_max' => 85, 'porcentaje_min' => 20, 'resguardo' => 6 ],
            [ 'id' => 24, 'ref' => 'TRAD',  'nombre' => 'BAJA 16 SEMANAS PILOTO(85%)',       'tipo_empenio' => 1, 'interes_semanal' => 1,    'plazos' => 16, 'dias_plazos' => 7, 'dias_gracia' => 10, 'porcentaje_max' => 85, 'porcentaje_min' => 20, 'resguardo' => 7 ],
            [ 'id' => 25, 'ref' => 'TRAD',  'nombre' => '16 SEMANAS 1.2',                    'tipo_empenio' => 1, 'interes_semanal' => 1.2,  'plazos' => 16, 'dias_plazos' => 7, 'dias_gracia' => 10, 'porcentaje_max' => 75, 'porcentaje_min' => 20, 'resguardo' => 7 ],
            [ 'id' => 26, 'ref' => 'TRAD',  'nombre' => '12 SEMANAS 1.1',                    'tipo_empenio' => 1, 'interes_semanal' => 1.1,  'plazos' => 12, 'dias_plazos' => 7, 'dias_gracia' => 15, 'porcentaje_max' => 80, 'porcentaje_min' => 20, 'resguardo' => 7 ],
            [ 'id' => 30, 'ref' => 'T13',   'nombre' => 'PLAZO 12SM 1.3 85',                 'tipo_empenio' => 1, 'interes_semanal' => 1.3,  'plazos' => 12, 'dias_plazos' => 7, 'dias_gracia' => 15, 'porcentaje_max' => 85, 'porcentaje_min' => 20, 'resguardo' => 7 ],
            [ 'id' => 31, 'ref' => 'T12',   'nombre' => '8 SEMANAS 1.25',                    'tipo_empenio' => 1, 'interes_semanal' => 1.25, 'plazos' => 8,  'dias_plazos' => 7, 'dias_gracia' => 15, 'porcentaje_max' => 90, 'porcentaje_min' => 20, 'resguardo' => 7 ],
            [ 'id' => 32, 'ref' => 'NP01',  'nombre' => 'AFORO 4SM 1.25 95',                 'tipo_empenio' => 1, 'interes_semanal' => 1.25, 'plazos' => 4,  'dias_plazos' => 7, 'dias_gracia' => 15, 'porcentaje_max' => 95, 'porcentaje_min' => 20, 'resguardo' => 7 ],
            [ 'id' => 33, 'ref' => 'NP02',  'nombre' => 'TASA 8SM 1.20 90',                  'tipo_empenio' => 1, 'interes_semanal' => 1.2,  'plazos' => 8,  'dias_plazos' => 7, 'dias_gracia' => 15, 'porcentaje_max' => 90, 'porcentaje_min' => 20, 'resguardo' => 7 ],
            [ 'id' => 34, 'ref' => 'VIP01', 'nombre' => 'PLAZO 12SM+1 1.3 85',               'tipo_empenio' => 1, 'interes_semanal' => 1.3,  'plazos' => 13, 'dias_plazos' => 7, 'dias_gracia' => 15, 'porcentaje_max' => 85, 'porcentaje_min' => 20, 'resguardo' => 7 ],
            [ 'id' => 35, 'ref' => 'VIP01', 'nombre' => 'AFORO 4SM+1 1.25 95',               'tipo_empenio' => 1, 'interes_semanal' => 1.25, 'plazos' => 5,  'dias_plazos' => 7, 'dias_gracia' => 15, 'porcentaje_max' => 95, 'porcentaje_min' => 20, 'resguardo' => 7 ],
            [ 'id' => 36, 'ref' => 'VIP01', 'nombre' => 'TASA 8SM+1 1.20 90',                'tipo_empenio' => 1, 'interes_semanal' => 1.2,  'plazos' => 9,  'dias_plazos' => 7, 'dias_gracia' => 15, 'porcentaje_max' => 90, 'porcentaje_min' => 20, 'resguardo' => 7 ],
            [ 'id' => 37, 'ref' => 'VIP02', 'nombre' => 'PLAZO 12SM+2 1.3 85',               'tipo_empenio' => 1, 'interes_semanal' => 1.3,  'plazos' => 14, 'dias_plazos' => 7, 'dias_gracia' => 15, 'porcentaje_max' => 85, 'porcentaje_min' => 20, 'resguardo' => 7 ],
            [ 'id' => 38, 'ref' => 'VIP02', 'nombre' => 'AFORO 4SM+2 1.25 95',               'tipo_empenio' => 1, 'interes_semanal' => 1.25, 'plazos' => 6,  'dias_plazos' => 7, 'dias_gracia' => 15, 'porcentaje_max' => 95, 'porcentaje_min' => 20, 'resguardo' => 7 ],
            [ 'id' => 39, 'ref' => 'VIP02', 'nombre' => 'TASA 8SM+2 1.20 90',                'tipo_empenio' => 1, 'interes_semanal' => 1.2,  'plazos' => 10, 'dias_plazos' => 7, 'dias_gracia' => 15, 'porcentaje_max' => 90, 'porcentaje_min' => 20, 'resguardo' => 7 ],
            [ 'id' => 40, 'ref' => 'CEL01', 'nombre' => 'CELULAR / TABLET 4SM',              'tipo_empenio' => 2, 'interes_semanal' => 1,    'plazos' => 4,  'dias_plazos' => 7, 'dias_gracia' => 5,  'porcentaje_max' => 55, 'porcentaje_min' => 35, 'resguardo' => 0 ],
        ]);


        DB::table('cat_prestamo_tipo_sedes')->insert([
            [ 'id' => 1, 'cat_prestamo_tipo_id' => 15, 'adm_sede_id' => 18 ],
            [ 'id' => 2, 'cat_prestamo_tipo_id' => 18, 'adm_sede_id' => 18 ],
            [ 'id' => 3, 'cat_prestamo_tipo_id' => 19, 'adm_sede_id' => 18 ],
            [ 'id' => 4, 'cat_prestamo_tipo_id' => 15, 'adm_sede_id' => 11 ],
            [ 'id' => 5, 'cat_prestamo_tipo_id' => 17, 'adm_sede_id' => 11 ],
            [ 'id' => 6, 'cat_prestamo_tipo_id' => 18, 'adm_sede_id' => 11 ],
            [ 'id' => 7, 'cat_prestamo_tipo_id' => 15, 'adm_sede_id' => 12 ],
            [ 'id' => 8, 'cat_prestamo_tipo_id' => 17, 'adm_sede_id' => 12 ],
            [ 'id' => 9, 'cat_prestamo_tipo_id' => 18, 'adm_sede_id' => 12 ],
            // [ 'id' => 10, 'cat_prestamo_tipo_id' => 15, 'adm_sede_id' => 155 ],
            [ 'id' => 11, 'cat_prestamo_tipo_id' => 17, 'adm_sede_id' => 15 ],
            // [ 'id' => 12, 'cat_prestamo_tipo_id' => 18, 'adm_sede_id' => 150 ],
            [ 'id' => 13, 'cat_prestamo_tipo_id' => 15, 'adm_sede_id' => 14 ],
            [ 'id' => 14, 'cat_prestamo_tipo_id' => 17, 'adm_sede_id' => 14 ],
            [ 'id' => 15, 'cat_prestamo_tipo_id' => 18, 'adm_sede_id' => 14 ],
            [ 'id' => 16, 'cat_prestamo_tipo_id' => 15, 'adm_sede_id' => 13 ],
            [ 'id' => 17, 'cat_prestamo_tipo_id' => 17, 'adm_sede_id' => 13 ],
            [ 'id' => 18, 'cat_prestamo_tipo_id' => 18, 'adm_sede_id' => 13 ],
            [ 'id' => 19, 'cat_prestamo_tipo_id' => 15, 'adm_sede_id' => 17 ],
            [ 'id' => 20, 'cat_prestamo_tipo_id' => 18, 'adm_sede_id' => 17 ],
            [ 'id' => 21, 'cat_prestamo_tipo_id' => 19, 'adm_sede_id' => 17 ],
            [ 'id' => 22, 'cat_prestamo_tipo_id' => 20, 'adm_sede_id' => 16 ],
            [ 'id' => 23, 'cat_prestamo_tipo_id' => 18, 'adm_sede_id' => 16 ],
            [ 'id' => 24, 'cat_prestamo_tipo_id' => 21, 'adm_sede_id' => 16 ],
            [ 'id' => 25, 'cat_prestamo_tipo_id' => 15, 'adm_sede_id' => 19 ],
            [ 'id' => 26, 'cat_prestamo_tipo_id' => 18, 'adm_sede_id' => 19 ],
            [ 'id' => 27, 'cat_prestamo_tipo_id' => 19, 'adm_sede_id' => 19 ],
            [ 'id' => 28, 'cat_prestamo_tipo_id' => 15, 'adm_sede_id' => 20 ],
            [ 'id' => 29, 'cat_prestamo_tipo_id' => 18, 'adm_sede_id' => 20 ],
            [ 'id' => 30, 'cat_prestamo_tipo_id' => 19, 'adm_sede_id' => 20 ],
            // [ 'id' => 31, 'cat_prestamo_tipo_id' => 22, 'adm_sede_id' => 150 ],
            // [ 'id' => 32, 'cat_prestamo_tipo_id' => 23, 'adm_sede_id' => 150 ],
            // [ 'id' => 33, 'cat_prestamo_tipo_id' => 24, 'adm_sede_id' => 88 ],
            // [ 'id' => 34, 'cat_prestamo_tipo_id' => 19, 'adm_sede_id' => 150 ],
            // [ 'id' => 35, 'cat_prestamo_tipo_id' => 25, 'adm_sede_id' => 150 ],
            // [ 'id' => 36, 'cat_prestamo_tipo_id' => 26, 'adm_sede_id' => 150 ],
            [ 'id' => 37, 'cat_prestamo_tipo_id' => 30, 'adm_sede_id' => 15 ],
            // [ 'id' => 38, 'cat_prestamo_tipo_id' => 31, 'adm_sede_id' => 150 ],
            [ 'id' => 39, 'cat_prestamo_tipo_id' => 32, 'adm_sede_id' => 15 ],
            [ 'id' => 40, 'cat_prestamo_tipo_id' => 33, 'adm_sede_id' => 15 ],
            [ 'id' => 41, 'cat_prestamo_tipo_id' => 34, 'adm_sede_id' => 15 ],
            [ 'id' => 42, 'cat_prestamo_tipo_id' => 35, 'adm_sede_id' => 15 ],
            [ 'id' => 43, 'cat_prestamo_tipo_id' => 36, 'adm_sede_id' => 15 ],
            [ 'id' => 44, 'cat_prestamo_tipo_id' => 37, 'adm_sede_id' => 15 ],
            [ 'id' => 45, 'cat_prestamo_tipo_id' => 38, 'adm_sede_id' => 15 ],
            [ 'id' => 46, 'cat_prestamo_tipo_id' => 39, 'adm_sede_id' => 15 ],
        ]);
        
    }
}
