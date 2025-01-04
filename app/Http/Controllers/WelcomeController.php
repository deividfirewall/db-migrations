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
            ['id'=> 0 ,'origen' => 'u_operadores', 'reg_o'=>DB::connection('sucursal')->table('u_operadores')->count()
                      ,'destino' => 'users','reg_d'=>DB::table('users')->count()
                      ,'descarga' => 0],
            ['id'=> 1 ,'origen' => 'u_pignotarios', 'reg_o'=>DB::connection('sucursal')->table('u_pignotarios')->count()
                      ,'destino' => 'pignorantes','reg_d'=>DB::table('pignorantes')->count()
                      ,'descarga' => 0],
            ['id'=> 2 ,'origen'    =>'t_boleta', 'reg_o'=>DB::connection('sucursal')->table('t_boleta')->count()
                      ,'destino'  => 't_boletas','reg_d'=>DB::table('t_boletas')->count()
                      ,'descarga' => 0],
            ['id'=> 3 ,'origen' => 't_boleta_pagos', 'reg_o'=>DB::connection('sucursal')->table('t_boleta_pagos')->count()
                      ,'destino' => 't_boleta_pagos','reg_d'=>DB::table('t_boleta_pagos')->count()
                      ,'descarga' => 0],
            ['id'=> 4 ,'origen' => 't_empenios', 'reg_o'=>DB::connection('sucursal')->table('t_empenios')->count()
                      ,'destino' => 't_empenios','reg_d'=>DB::table('t_empenios')->count()
                      ,'descarga' => 0],
            ['id'=> 5 ,'origen' => 't_empenios_boleta_relacion', 'reg_o'=>DB::connection('sucursal')->table('t_empenios_boleta_relacion')->count()
                      ,'destino' => 't_emp_bol_relations','reg_d'=>DB::table('t_emp_bol_relations')->count()
                      ,'descarga' => 0],
            ['id'=> 6 ,'origen' => 't_empenios_metal', 'reg_o'=>DB::connection('sucursal')->table('t_empenios_metal')->count()
                      ,'destino' => 't_empenio_metals','reg_d'=>DB::table('t_empenio_metals')->count()
                      ,'descarga' => 0],
            ['id'=> 7 ,'origen' => 't_empenios_productos', 'reg_o'=>DB::connection('sucursal')->table('t_empenios_productos')->count()
                      ,'destino' => 't_empenio_products','reg_d'=>DB::table('t_empenio_products')->count()
                      ,'descarga' => 0],
            ['id'=> 8 ,'origen' => 't_control_interno', 'reg_o'=>DB::connection('sucursal')->table('t_control_interno')->count()
                      ,'destino' => 't_ctrl_internos','reg_d'=>DB::table('t_ctrl_internos')->count()
                      ,'descarga' => 0],
            ['id'=> 9 ,'origen' => 't_caja_monto_operador', 'reg_o'=>DB::connection('sucursal')->table('t_caja_monto_operador')->count()
                      ,'destino' => 't_cajas','reg_d'=>DB::table('t_cajas')->count()
                      ,'descarga' => 0],
            ['id'=> 10,'origen' => 'h_t_boleta', 'reg_o'=>DB::connection('sucursal')->table('h_t_boleta')->count()
                      ,'destino' => 'h_boletas','reg_d'=>DB::table('h_boletas')->count()
                      ,'descarga' => 0],
            ['id'=> 11,'origen' => 'u_pignotarios_solidarios', 'reg_o'=>DB::connection('sucursal')->table('u_pignotarios_solidarios')->count()
                      ,'destino' => 'pignorante_solidarios','reg_d'=>DB::table('pignorante_solidarios')->count()
                      ,'descarga' => 0],
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
        $databaseName = DB::connection()->getDatabaseName();

        $allTables = $this->allTables;
        return view('welcome', compact('databaseName', 'allTables'));
    }
}
