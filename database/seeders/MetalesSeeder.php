<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cat_metal_tipos = [
            ['id' => 1, 'metal_tipo' => 'oro'],
            ['id' => 2, 'metal_tipo' => 'plata'],
        ];
        
        DB::table('cat_metal_tipos')->insert($cat_metal_tipos);
        
        $cat_metal_precios = [
            [
                'id' => 1,
                'precio_compra' => 24000,
                'precio_venta' => 25500,
                'precio_gramo' => 1760,
                'precio_gramo_venta' => 1760,
                'gramos' => 37.5,
                'base' => 'CENTENARIO',
                'cat_metal_tipo_id' => 1
            ],
            [
                'id' => 2,
                'precio_compra' => 435,
                'precio_venta' => 435,
                'precio_gramo' => 26.43,
                'precio_gramo_venta' => 26.43,
                'gramos' => 31.07,
                'base' => 'ONZA LIBERTAD',
                'cat_metal_tipo_id' => 2
            ]
        ];
        DB::table('cat_metal_precios')->insert($cat_metal_precios);
       
        $cat_metal_cotizas = [
            ['id' => 1,  'ref' => '10E',   'nombre' => 'ORO 10K',    'kilates' => 10,    'eq_oro' => 0.4167, 'por_vc' => 12.36,  'por_cv' => 60,   'por_aval' => 19.09, 'cat_metal_tipo_id' => 1 ],
            ['id' => 4,  'ref' => '14E',   'nombre' => 'ORO 14K',    'kilates' => 14,    'eq_oro' => 0.5833, 'por_vc' => 12.361, 'por_cv' => 60,   'por_aval' => 19.11, 'cat_metal_tipo_id' => 1 ],
            ['id' => 7,  'ref' => '18E',   'nombre' => 'ORO 18K',    'kilates' => 18,    'eq_oro' => 0.75,   'por_vc' => 12.36,  'por_cv' => 0,    'por_aval' => 19.1,  'cat_metal_tipo_id' => 1 ],
            ['id' => 13, 'ref' => '12E',   'nombre' => 'ORO 12K',    'kilates' => 12,    'eq_oro' => 0.5,    'por_vc' => 12.361, 'por_cv' => 0,    'por_aval' => 19.1,  'cat_metal_tipo_id' => 1 ],
            ['id' => 14, 'ref' => '8E',    'nombre' => 'ORO 8K',     'kilates' => 8,     'eq_oro' => 0.3333, 'por_vc' => 12.358, 'por_cv' => 0,    'por_aval' => 19.12, 'cat_metal_tipo_id' => 1 ],
            ['id' => 15, 'ref' => '21E',   'nombre' => 'ORO 21K',    'kilates' => 21,    'eq_oro' => 0.875,  'por_vc' => 15.571, 'por_cv' => 0,    'por_aval' => 22.51, 'cat_metal_tipo_id' => 1 ],
            ['id' => 16, 'ref' => '22E',   'nombre' => 'ORO 22K',    'kilates' => 22,    'eq_oro' => 0.9167, 'por_vc' => 12.361, 'por_cv' => 0,    'por_aval' => 19.1,  'cat_metal_tipo_id' => 1 ],
            ['id' => 17, 'ref' => '24E',   'nombre' => 'ORO 24K',    'kilates' => 24,    'eq_oro' => 1,      'por_vc' => 12.361, 'por_cv' => 0,    'por_aval' => 19.1,  'cat_metal_tipo_id' => 1 ],
            ['id' => 20, 'ref' => 'PL720', 'nombre' => 'PLATA .720', 'kilates' => 17.28, 'eq_oro' => 0.72,   'por_vc' => 38.88,  'por_cv' => 0,    'por_aval' => 38.88, 'cat_metal_tipo_id' => 2 ],
            ['id' => 21, 'ref' => 'PL925', 'nombre' => 'PLATA .925', 'kilates' => 22.2,  'eq_oro' => 0.925,  'por_vc' => 8.1,    'por_cv' => 0,    'por_aval' => 8.1,   'cat_metal_tipo_id' => 2 ],
            ['id' => 22, 'ref' => 'PL999', 'nombre' => 'PLATA .999', 'kilates' => 23.98, 'eq_oro' => 0.9992, 'por_vc' => 0.1,    'por_cv' => 0,    'por_aval' => 0.1,   'cat_metal_tipo_id' => 2 ],
            ['id' => 23, 'ref' => '21.6E', 'nombre' => 'ORO 21.6 K', 'kilates' => 21.6,  'eq_oro' => 0.9,    'por_vc' => NULL,   'por_cv' => NULL, 'por_aval' => NULL,  'cat_metal_tipo_id' => 1 ]
        ];
        DB::table('cat_metal_cotizas')->insert($cat_metal_cotizas);   

    }
}
