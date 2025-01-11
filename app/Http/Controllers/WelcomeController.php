<?php

namespace App\Http\Controllers;

use App\Models\Tables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public $allTables = [];

    public function __construct()
    {
        $this->allTables = [

            1 => ['origen'  => 'u_operadores',              'file_size'=> 0, 'destino' => 'users',                 'avance'=> 0, 'descarga'=> 0],
            2 => ['origen'  => 'u_pignotarios',             'file_size'=> 0, 'destino' => 'pignorantes',           'avance'=> 0, 'descarga'=> 0],
            3 => ['origen'  => 't_boleta',                  'file_size'=> 0, 'destino' => 't_boletas',             'avance'=> 0, 'descarga'=> 0],
            4 => ['origen'  => 't_boleta_pagos',            'file_size'=> 0, 'destino' => 't_boleta_pagos',        'avance'=> 0, 'descarga'=> 0],
            5 => ['origen'  => 't_empenios',                'file_size'=> 0, 'destino' => 't_empenios',            'avance'=> 0, 'descarga'=> 0],
            6 => ['origen'  => 't_empenios_boleta_relacion','file_size'=> 0, 'destino' => 't_emp_bol_relations',   'avance'=> 0, 'descarga'=> 0],
            7 => ['origen'  => 't_empenios_metal',          'file_size'=> 0, 'destino' => 't_empenio_metals',      'avance'=> 0, 'descarga'=> 0],
            8 => ['origen'  => 't_empenios_productos',      'file_size'=> 0, 'destino' => 't_empenio_products',    'avance'=> 0, 'descarga'=> 0],
            9 => ['origen'  => 't_control_interno',         'file_size'=> 0, 'destino' => 't_ctrl_internos',       'avance'=> 0, 'descarga'=> 0],
            10=> ['origen'  => 't_caja_monto_operador',     'file_size'=> 0, 'destino' => 't_cajas',               'avance'=> 0, 'descarga'=> 0],
            11=> ['origen'  => 'h_t_boleta',                'file_size'=> 0, 'destino' => 'h_boletas',             'avance'=> 0, 'descarga'=> 0],
            12=> ['origen'  => 'u_pignotarios_solidarios',  'file_size'=> 0, 'destino' => 'pignorante_solidarios', 'avance'=> 0, 'descarga'=> 0],
            14=> ['origen'  => 't_solicitudes_dias_gracia', 'file_size'=> 0, 'destino' => 't_sol_dias_gracias',    'avance'=> 0, 'descarga'=> 0],
            15=> ['origen'  => 't_solicitudes_almoneda',    'file_size'=> 0, 'destino' => 't_sol_almonedas',       'avance'=> 0, 'descarga'=> 0],
            16=> ['origen'  => 't_solicitudes_subasta',     'file_size'=> 0, 'destino' => 't_sol_subastas',        'avance'=> 0, 'descarga'=> 0],
            17=> ['origen'  => 't_subasta',                 'file_size'=> 0, 'destino' => 't_subastas',            'avance'=> 0, 'descarga'=> 0],
            18=> ['origen'  => 'c_fecha_subasta',           'file_size'=> 0, 'destino' => 't_subasta_fechas',      'avance'=> 0, 'descarga'=> 0],    
            19=> ['origen'  => 't_comprador',               'file_size'=> 0, 'destino' => 't_compradors',          'avance'=> 0, 'descarga'=> 0],
            20=> ['origen'  => 't_retasas',                 'file_size'=> 0, 'destino' => 't_retasas',             'avance'=> 0, 'descarga'=> 0],
            21=> ['origen'  => 't_reposicion',              'file_size'=> 0, 'destino' => 't_reposicions',         'avance'=> 0, 'descarga'=> 0],            
            22=> ['origen'  => 't_concentrados',            'file_size'=> 0, 'destino' => 't_concentrados',        'avance'=> 0, 'descarga'=> 0], 
            23=> ['origen'  => 't_venta_vitrina',           'file_size'=> 0, 'destino' => 't_vitrina_ventas',      'avance'=> 0, 'descarga'=> 0],
            24=> ['origen'  => 't_compra_vitrina',          'file_size'=> 0, 'destino' => 't_vitrina_compras',     'avance'=> 0, 'descarga'=> 0],
            25=> ['origen'  => 't_demasias_pagadas',        'file_size'=> 0, 'destino' => 't_demasias_pagadas',    'avance'=> 0, 'descarga'=> 0],
            26=> ['origen'  => 't_suspencion_dias',         'file_size'=> 0, 'destino' => 't_suspencion_dias',     'avance'=> 0, 'descarga'=> 0], 
        ];

        $tables_db = Tables::all();
      
        foreach($this->allTables as $key => $table){

            $filePath = storage_path('app/public/bkp_' . $table['destino'].'.zip');
            
            $tables_db = $tables_db->where('id', $key)->first();
            

            $this->allTables[$key]['avance'] = $tables_db->avance;
            if (file_exists($filePath)) {
                // $file_size = round(filesize($filePath)/1024,1);
                // if($file_size > 1024)
                //     $file_size = round($file_size/1024,1).' MB';
                // else
                //     $file_size = $file_size.' KB';

                $this->allTables[$key]['file_size'] = filesize($filePath);

                $this->allTables[$key]['descarga'] = 1;

            } 

        }
    }
    public function index()
    {
        $databaseName = DB::connection('sucursal')->getDatabaseName();

        $allTables = $this->allTables;
        return view('welcome', compact('databaseName', 'allTables'));
    }
}
