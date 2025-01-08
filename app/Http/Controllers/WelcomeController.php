<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public $allTables = [];

    public function __construct()
    {
        $this->allTables = [
            ['id'=> 0 ,'origen'  => 'u_operadores', 'reg_o'=>DB::connection('sucursal')->table('u_operadores')->count()
                      ,'destino' => 'users',        'reg_d'=>DB::table('users')->count()
                      ,'descarga'=> 0],
            ['id'=> 1 ,'origen'  => 'u_pignotarios','reg_o'=>DB::connection('sucursal')->table('u_pignotarios')->count()
                      ,'destino' => 'pignorantes',  'reg_d'=>DB::table('pignorantes')->count()
                      ,'descarga'=> 0],
            ['id'=> 2 ,'origen'  =>'t_boleta',     'reg_o'=>DB::connection('sucursal')->table('t_boleta')->count()
                      ,'destino' => 't_boletas',   'reg_d'=>DB::table('t_boletas')->count()
                      ,'descarga'=> 0],
            ['id'=> 3 ,'origen'  => 't_boleta_pagos','reg_o'=>DB::connection('sucursal')->table('t_boleta_pagos')->count()
                      ,'destino' => 't_boleta_pagos','reg_d'=>DB::table('t_boleta_pagos')->count()
                      ,'descarga'=> 0],
            ['id'=> 4 ,'origen'  => 't_empenios',   'reg_o'=>DB::connection('sucursal')->table('t_empenios')->count()
                      ,'destino' => 't_empenios',   'reg_d'=>DB::table('t_empenios')->count()
                      ,'descarga'=> 0],
            ['id'=> 5 ,'origen'  => 't_empenios_boleta_relacion','reg_o'=>DB::connection('sucursal')->table('t_empenios_boleta_relacion')->count()
                      ,'destino' => 't_emp_bol_relations',       'reg_d'=>DB::table('t_emp_bol_relations')->count()
                      ,'descarga'=> 0],
            ['id'=> 6 ,'origen'  => 't_empenios_metal', 'reg_o'=>DB::connection('sucursal')->table('t_empenios_metal')->count()
                      ,'destino' => 't_empenio_metals', 'reg_d'=>DB::table('t_empenio_metals')->count()
                      ,'descarga'=> 0],
            ['id'=> 7 ,'origen'  => 't_empenios_productos', 'reg_o'=>DB::connection('sucursal')->table('t_empenios_productos')->count()
                      ,'destino' => 't_empenio_products',   'reg_d'=>DB::table('t_empenio_products')->count()
                      ,'descarga'=> 0],
            ['id'=> 8 ,'origen'  => 't_control_interno','reg_o'=>DB::connection('sucursal')->table('t_control_interno')->count()
                      ,'destino' => 't_ctrl_internos',  'reg_d'=>DB::table('t_ctrl_internos')->count()
                      ,'descarga'=> 0],
            ['id'=> 9 ,'origen'  => 't_caja_monto_operador','reg_o'=>DB::connection('sucursal')->table('t_caja_monto_operador')->count()
                      ,'destino' => 't_cajas',              'reg_d'=>DB::table('t_cajas')->count()
                      ,'descarga'=> 0],
            ['id'=> 10,'origen'  => 'h_t_boleta','reg_o'=>DB::connection('sucursal')->table('h_t_boleta')->count()
                      ,'destino' => 'h_boletas', 'reg_d'=>DB::table('h_boletas')->count()
                      ,'descarga'=> 0],
            ['id'=> 11,'origen'  => 'u_pignotarios_solidarios','reg_o'=>DB::connection('sucursal')->table('u_pignotarios_solidarios')->count()
                      ,'destino' => 'pignorante_solidarios',   'reg_d'=>DB::table('pignorante_solidarios')->count()
                      ,'descarga'=> 0],
            ['id'=> 12,'origen'  => 't_solicitudes_dias_gracia', 'reg_o'=> DB::connection('sucursal')->table('t_solicitudes_dias_gracia')->count()
                      ,'destino' => 't_sol_dias_gracias',        'reg_d'=> DB::table('t_sol_dias_gracias')->count()
                      ,'descarga'=> 0],
            ['id'=> 13,'origen'  => 't_solicitudes_almoneda', 'reg_o'=> DB::connection('sucursal')->table('t_solicitudes_almoneda')->count()
                      ,'destino' => 't_sol_almonedas',        'reg_d'=> DB::table('t_sol_almonedas')->count()
                      ,'descarga'=> 0],
            ['id'=> 14,'origen'  => 't_solicitudes_subasta',  'reg_o'=> DB::connection('sucursal')->table('t_solicitudes_subasta')->count()
                      ,'destino' => 't_sol_subastas',         'reg_d'=> DB::table('t_sol_subastas')->count()
                      ,'descarga'=> 0],
            ['id'=> 15,'origen'  => 't_subasta',              'reg_o'=> DB::connection('sucursal')->table('t_subasta')->count()
                      ,'destino' => 't_subastas',             'reg_d'=> DB::table('t_subastas')->count()
                      ,'descarga'=> 0],
            ['id'=> 16,'origen'  => 'c_fecha_subasta',  'reg_o'=> DB::connection('sucursal')->table('c_fecha_subasta')->count()
                      ,'destino' => 't_subasta_fechas', 'reg_d'=> DB::table('t_subasta_fechas')->count()
                      ,'descarga'=> 0],    
            ['id'=> 17,'origen'  => 't_comprador',  'reg_o'=> DB::connection('sucursal')->table('t_comprador')->count()
                      ,'destino' => 't_compradors', 'reg_d'=> DB::table('t_compradors')->count()
                      ,'descarga'=> 0],
            ['id'=> 18,'origen'  => 't_retasas',    'reg_o'=> DB::connection('sucursal')->table('t_retasas')->count()
                      ,'destino' => 't_retasas',    'reg_d'=> DB::table('t_retasas')->count()
                      ,'descarga'=> 0],
            ['id'=> 19,'origen'  => 't_reposicion',    'reg_o'=> DB::connection('sucursal')->table('t_reposicion')->count()
                      ,'destino' => 't_reposicions',   'reg_d'=> DB::table('t_reposicions')->count()
                      ,'descarga'=> 0],            
            ['id'=> 20,'origen'  => 't_concentrados',    'reg_o'=> DB::connection('sucursal')->table('t_concentrados')->count()
                      ,'destino' => 't_concentrados',    'reg_d'=> DB::table('t_concentrados')->count()
                      ,'descarga'=> 0], 
            ['id'=> 21,'origen'  => 't_venta_vitrina',    'reg_o'=> DB::connection('sucursal')->table('t_venta_vitrina')->count()
                      ,'destino' => 't_vitrina_ventas',   'reg_d'=> DB::table('t_vitrina_ventas')->count()
                      ,'descarga'=> 0],
            ['id'=> 22,'origen'  => 't_compra_vitrina',    'reg_o'=> DB::connection('sucursal')->table('t_compra_vitrina')->count()
                      ,'destino' => 't_vitrina_compras',   'reg_d'=> DB::table('t_vitrina_compras')->count()
                      ,'descarga'=> 0],
            ['id'=> 23,'origen'  => 't_demasias_pagadas', 'reg_o'=> DB::connection('sucursal')->table('t_demasias_pagadas')->count()
                      ,'destino' => 't_demasias_pagadas', 'reg_d'=> DB::table('t_demasias_pagadas')->count()
                      ,'descarga'=> 0],
            ['id'=> 24,'origen'  => 't_suspencion_dias', 'reg_o'=> DB::connection('sucursal')->table('t_suspencion_dias')->count()
                      ,'destino' => 't_suspencion_dias', 'reg_d'=> DB::table('t_suspencion_dias')->count()
                      ,'descarga'=> 0], 

        ];

        
        foreach($this->allTables as $key => $table){

            $filePath = storage_path('app/public/bkp_' . $table['destino'].'.zip');
            
            if (file_exists($filePath)) {
                $this->allTables[$key]['descarga'] =1;
                
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
