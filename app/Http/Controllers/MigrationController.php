<?php

namespace App\Http\Controllers;

use App\Models\PignoranteSolidario;
use App\Models\Tables;
use App\Models\TBoleta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MigrationController extends Controller
{
    public $allTables = [];

    public function __construct()
    {
        $this->allTables = [
            1  => ['origen' =>'u_operadores',               'reg_o'=> 0,'destino'=>'users'                ,'reg_d'=> 0   ,'avance'=>'0'],
            2  => ['origen' =>'u_pignotarios',              'reg_o'=> 0,'destino'=>'pignorantes'          ,'reg_d'=> 0   ,'avance'=>'0'],
            3  => ['origen' =>'t_boleta',                   'reg_o'=> 0,'destino' =>'t_boletas'           ,'reg_d'=> 0   ,'avance'=>'0'],
            4  => ['origen' =>'t_boleta_pagos',             'reg_o'=> 0,'destino'=>'t_boleta_pagos'       ,'reg_d'=> 0   ,'avance'=>'0'],
            5  => ['origen' =>'t_empenios',                 'reg_o'=> 0,'destino'=>'t_empenios'           ,'reg_d'=> 0   ,'avance'=>'0'],
            6  => ['origen' =>'t_empenios_boleta_relacion', 'reg_o'=> 0,'destino'=>'t_emp_bol_relations'  ,'reg_d'=> 0   ,'avance'=>'0'],
            7  => ['origen' =>'t_empenios_metal',           'reg_o'=> 0,'destino'=>'t_empenio_metals'     ,'reg_d'=> 0   ,'avance'=>'0'],
            8  => ['origen' =>'t_empenios_productos',       'reg_o'=> 0,'destino'=>'t_empenio_products'   ,'reg_d'=> 0   ,'avance'=>'0'],
            9  => ['origen' =>'t_control_interno',          'reg_o'=> 0,'destino'=>'t_ctrl_internos'      ,'reg_d'=> 0   ,'avance'=>'0'],
            10 => ['origen' =>'t_caja_monto_operador',      'reg_o'=> 0,'destino'=>'t_cajas'              ,'reg_d'=> 0   ,'avance'=>'0'],
            11 => ['origen' =>'h_t_boleta',                 'reg_o'=> 0,'destino'=>'h_boletas'            ,'reg_d'=> 0   ,'avance'=>'0'],
            12 => ['origen' =>'u_pignotarios_solidarios',   'reg_o'=> 0,'destino'=>'pignorante_solidarios','reg_d'=> 0   ,'avance'=>'0'],
            13 => ['origen' =>'u_pignotarios_solidarios',   'reg_o'=> 0,'destino'=>'pignorante_solidarios','reg_d'=> 0   ,'avance'=>'0'],
            14 => ['origen' =>'t_solicitudes_dias_gracia',  'reg_o'=> 0,'destino'=>'t_sol_dias_gracias'   ,'reg_d'=> 0   ,'avance'=>'0'],
            15 => ['origen' =>'t_solicitudes_almoneda',     'reg_o'=> 0,'destino'=>'t_sol_almonedas'      ,'reg_d'=> 0   ,'avance'=>'0'],
            16 => ['origen' =>'t_solicitudes_subasta',      'reg_o'=> 0,'destino'=>'t_sol_subastas'       ,'reg_d'=> 0   ,'avance'=>'0'],
            17 => ['origen' =>'t_subasta',                  'reg_o'=> 0,'destino'=>'t_subastas'           ,'reg_d'=> 0   ,'avance'=>'0'],
            18 => ['origen' =>'c_fecha_subasta',            'reg_o'=> 0,'destino'=>'t_subasta_fechas'     ,'reg_d'=> 0   ,'avance'=>'0'],    
            19 => ['origen' =>'t_comprador',                'reg_o'=> 0,'destino'=>'t_compradors'         ,'reg_d'=> 0   ,'avance'=>'0'],
            20 => ['origen' =>'t_retasas',                  'reg_o'=> 0,'destino'=>'t_retasas'            ,'reg_d'=> 0   ,'avance'=>'0'],
            21 => ['origen' =>'t_reposicion',               'reg_o'=> 0,'destino'=>'t_reposicions'        ,'reg_d'=> 0   ,'avance'=>'0'],            
            22 => ['origen' =>'t_concentrados',             'reg_o'=> 0,'destino'=>'t_concentrados'       ,'reg_d'=> 0   ,'avance'=>'0'], 
            23 => ['origen' =>'t_venta_vitrina',            'reg_o'=> 0,'destino'=>'t_vitrina_ventas'     ,'reg_d'=> 0   ,'avance'=>'0'],
            24 => ['origen' =>'t_compra_vitrina',           'reg_o'=> 0,'destino'=>'t_vitrina_compras'    ,'reg_d'=> 0   ,'avance'=>'0'],
            25 => ['origen' =>'t_demasias_pagadas',         'reg_o'=> 0,'destino'=>'t_demasias_pagadas'   ,'reg_d'=> 0   ,'avance'=>'0'],
            26 => ['origen' =>'t_suspencion_dias',          'reg_o'=> 0,'destino'=>'t_suspencion_dias'    ,'reg_d'=> 0   ,'avance'=>'0'],
            27 => ['origen' =>'t_descuentos',               'reg_o'=> 0,'destino'=>'t_descuentos'         ,'reg_d'=> 0   ,'avance'=>'0'],
            // 28 => ['origen' =>'t_num_tickets',              'reg_o'=> 0,'destino'=>'t_num_tickets'        ,'reg_d'=> 0   ,'avance'=>'0'],
            // 29 => ['origen' =>'t_boleta_cancelado',         'reg_o'=> 0,'destino'=>'t_boleta_cancels'     ,'reg_d'=> 0   ,'avance'=>'0'],
            // 30 => ['origen' =>'t_control_interno_cancelado','reg_o'=> 0,'destino'=>'t_ctrl_int_cancels'   ,'reg_d'=> 0   ,'avance'=>'0'],  
            // 31 => ['origen' =>'rg_rod13',                   'reg_o'=> 0,'destino'=>'rpt01_diarios'        ,'reg_d'=> 0   ,'avance'=>'0'],          
            // 32 => ['origen' =>'r_rg_cg11',                  'reg_o'=> 0,'destino'=>'rpt02_grales'         ,'reg_d'=> 0   ,'avance'=>'0'],
            // 33 => ['origen' =>'r_ro_cg12',                  'reg_o'=> 0,'destino'=>'rpt03_diario'         ,'reg_d'=> 0   ,'avance'=>'0'],
        ];


        /* Faltan las tablas
            rg_rod13
            r_rg_cg11
            r_ro_cg12 [u_operador_id]
            t_boleta_cancelado [t_boleta_id, u_operador_id, c_status_empenio_id, c_tipo_operacion_id, u_pignorante_id, c_tipo_producto_id]
            t_control_interno_cancelado [t_boleta_id]
            t_descuentos [t_boleta_id, u_operador_id, c_status, c_status_operacion_id]
            t_num_tickets [t_boleta_id, c_status_boleta_id]
            
            
            t_bloqueadas        SOLO HAY 46 BOLETAS antigua:10460349 del 2019-12-06, reciente:10555424 DEL 2020-02-28
            t_boletas_pagos_mal_no_venta    >>> 127 boletas, ultimo uso en 2018
            t_boleta_migracion              >>> ultimo uso en 2014
            u_directores                    >>> ahora se utiliza la tabla users
        */
        $databaseName = DB::connection('sucursal')->getDatabaseName();

        $tables_ctrl = Tables::all();
        
        foreach ($this->allTables as $key => $table) {

            $table_ctrl = $tables_ctrl->where('id', $key)->first();
        
            if($table_ctrl){
                $this->allTables[$key]['reg_o'] = $table_ctrl->num_registros_origen;
                $this->allTables[$key]['reg_d'] = $table_ctrl->num_registros_destino;
                $this->allTables[$key]['avance'] = $table_ctrl->avance;
                
            }else{
                $this->PreventIntegrityConstraintViolation($table['origen'], $databaseName);

                if($key == 12){
                    $num_registros_origen = DB::connection('sucursal')->table('u_pignotarios_solidarios')->distinct()
                    ->select('u_pignotarios_solidarios.pignorante_solidario','t_boleta.u_pignorante_id')
                    ->join('t_boleta','t_boleta.id','=','u_pignotarios_solidarios.t_boleta_id')
                    ->get()->count();
                }elseif($key == 13){
                    $num_registros_origen = DB::connection('sucursal')->table('u_pignotarios_solidarios')
                       ->join('t_boleta','t_boleta.id','u_pignotarios_solidarios.t_boleta_id')
                       ->count();                       
                }else{
                    $num_registros_origen = DB::connection('sucursal')->table($table['origen'])->count();
                }
                Tables::create([
                    'id' => $key,
                    'tabla_origen' => $table['origen'],
                    'num_registros_origen' => $num_registros_origen,
                    'tabla_destino' => $table['destino'],
                    'num_registros_destino' => 0,
                    'avance' => 0,
                ]);
            }

            //$this->allTables[$key]['avance'] = $table['reg_d'] > 0 ? number_format(($table['reg_d']/$table['reg_o'])*100, 1) : '0';
        }
    }
    public function PreventIntegrityConstraintViolation($table, $databaseName){

        switch ($databaseName) {
            case 'siemp_ixcotel':
                DB::update("UPDATE `t_suspencion_dias`SET `u_operadores_id` = 5 WHERE 1");
                break;
            case 'siemp_xoxo26':
                DB::update("UPDATE `t_suspencion_dias`SET `u_operadores_id` = 5 WHERE 1");
                break;
            default:
                break;
        }


        switch ($table) {
            case 't_boleta_pagos':
                $TBoletaPagos = DB::connection('sucursal')->select(
                    'SELECT DISTINCT t_boleta_pagos.t_boleta_id 
                     FROM t_boleta_pagos 
                     LEFT JOIN t_boleta ON t_boleta_pagos.t_boleta_id = t_boleta.id 
                     WHERE t_boleta.id IS null;'
                );
                
                if($TBoletaPagos){
                    $affected = DB::connection('sucursal')->update(
                        'DELETE t_boleta_pagos 
                         FROM t_boleta_pagos 
                         LEFT JOIN t_boleta ON t_boleta_pagos.t_boleta_id = t_boleta.id 
                         WHERE t_boleta.id IS null;'
                    );
                }
                break;
            case 't_empenios':
                $TEmpeños = DB::connection('sucursal')->select(
                   'SELECT t_empenios.*
                    FROM    t_empenios
                    LEFT JOIN t_empenios_boleta_relacion ON t_empenios_boleta_relacion.t_empenios_id = t_empenios.id
                    WHERE t_empenios_boleta_relacion.id IS NULL;'
                );
                if($TEmpeños){
                    $affected = DB::connection('sucursal')->update(
                       'DELETE t_empenios 
                        FROM t_empenios 
                        LEFT JOIN t_empenios_boleta_relacion ON t_empenios_boleta_relacion.t_empenios_id = t_empenios.id
                        WHERE t_empenios_boleta_relacion.id IS NULL;'
                    );
                }
                break;
            case 't_empenios_boleta_relacion':
                $TEmpeños = DB::connection('sucursal')->select(
                    'SELECT DISTINCT t_empenios_boleta_relacion.t_boleta_id, t_empenios.id 
                     FROM t_empenios_boleta_relacion 
                     LEFT JOIN t_boleta ON t_empenios_boleta_relacion.t_boleta_id = t_boleta.id 
                     LEFT JOIN t_empenios ON t_empenios_boleta_relacion.t_empenios_id = t_empenios.id 
                     WHERE t_boleta.id IS NULL;'
                );
                if($TEmpeños){
                    $affected = DB::connection('sucursal')->update(
                        'DELETE t_empenios_boleta_relacion 
                        FROM t_empenios_boleta_relacion 
                        LEFT JOIN t_boleta ON t_empenios_boleta_relacion.t_boleta_id = t_boleta.id 
                        LEFT JOIN t_empenios ON t_empenios_boleta_relacion.t_empenios_id = t_empenios.id 
                        WHERE t_boleta.id IS NULL;'
                    );
                }
                break;
            case 't_empenios_metal':
                $TEmpeños = DB::connection('sucursal')->select(
                   'SELECT t_empenios_metal.* 
                    FROM t_empenios_metal
                    LEFT JOIN t_empenios_boleta_relacion ON t_empenios_boleta_relacion.t_empenios_id = t_empenios_metal.t_empenios_id
                    WHERE t_empenios_boleta_relacion.id IS NULL;'
                );
                if($TEmpeños){
                    $affected = DB::connection('sucursal')->update(
                       'DELETE t_empenios_metal
                        FROM    t_empenios_metal
                        LEFT JOIN t_empenios_boleta_relacion ON t_empenios_boleta_relacion.t_empenios_id = t_empenios_metal.t_empenios_id
                        WHERE t_empenios_boleta_relacion.id IS NULL;'
                    );
                }
                break;
            case 't_empenios_productos':
                $TEmpeños = DB::connection('sucursal')->select(
                    'SELECT t_empenios_productos.* 
                     FROM t_empenios_productos
                     LEFT JOIN t_empenios_boleta_relacion ON t_empenios_boleta_relacion.t_empenios_id = t_empenios_productos.t_empenios_id
                     WHERE t_empenios_boleta_relacion.id IS NULL;'
                );
                if($TEmpeños){
                    $affected = DB::connection('sucursal')->update(
                        'DELETE t_empenios_productos
                         FROM    t_empenios_productos
                         LEFT JOIN t_empenios_boleta_relacion ON t_empenios_boleta_relacion.t_empenios_id = t_empenios_productos.t_empenios_id
                         WHERE t_empenios_boleta_relacion.id IS NULL;'
                    );
                }
                break;
            case 't_comprador':
                DB::connection('sucursal')->update("UPDATE `t_comprador` SET `rfc` = null WHERE rfc = 'xxx';");
                DB::connection('sucursal')->update("UPDATE `t_comprador` SET `rfc` = null WHERE rfc = '';");
                DB::connection('sucursal')->update("UPDATE `t_comprador` SET `ife` = null WHERE ife = 'xxx';");
                DB::connection('sucursal')->update("UPDATE `t_comprador` SET `ife` = null WHERE ife = '';");
                DB::connection('sucursal')->update("UPDATE `t_comprador` SET `curp` = null WHERE curp = 'xxx';");
                DB::connection('sucursal')->update("UPDATE `t_comprador` SET `curp` = null WHERE curp = '';");
                break;
            default:
                break;
        }

       
    }
    public function index(){
        $databaseName = DB::connection('sucursal')->getDatabaseName();

        $allTables = $this->allTables;
        return view('migrations', compact('databaseName', 'allTables'));

        /*  ELIMINAMOS 29 TABLAS INNECESARIAS         
         DROP TABLE 
            c_cotiza_producto_08112015, 
            c_fecha_reporte, 
            c_nivel, 
            c_printer_operador, 
            c_printer_operador_tipo, 
            c_sub_productos_08112015, 
            c_sub_productos_2014_12_12, 
            c_sucursal_12042015, 
            c_sucursal_v1, 
            c_status_usuario,
            c_intereses,
            c_tipo_prestamo_12042015, 
            c_tipo_printer, 
            h_rp_subasta, 
            rg_dda07, 
            rg_ddd04, 
            rg_de02, 
            rg_dra06, 
            rg_drd03, 
            temporal, 
            t_boleta_202006, 
            t_boleta_pagos_19022015, 
            t_boleta_pagos_old_19022015,
            t_boetas_pagos_mal_NoVenta, 
            t_boleta_migracion,
            t_empenios_2014_12_12, 
            t_empenios_metal_2014_12_12, 
            t_empenios_productos_2014_12_12, 
            t_migration_missing, 
            t_subasta_copy;
        */
    
        /* u_pignotarios: Antes de migrar, se debera de ejecutar lo siguiente en la base de datos origen
            SELECT * FROM `u_pignotarios` WHERE nombre LIKE "%‘%";          SON 409 REGISTROS
            UPDATE u_pignotarios SET nombre = TRIM(nombre);
            UPDATE u_pignotarios SET nombre = REPLACE(nombre, '  ', ' ');
            UPDATE u_pignotarios SET nombre = REPLACE(nombre, 'ÃƒÂƒÃ‚', 'ª'); 
            UPDATE u_pignotarios SET nombre = REPLACE(nombre, 'ÂƒÃƒÂ‚', 'ª'); 
            UPDATE u_pignotarios SET nombre = REPLACE(nombre, 'ÃƒÂ‚', 'ª'); 
            UPDATE u_pignotarios SET nombre = REPLACE(nombre, 'Ã‚', 'ª'); 
            UPDATE u_pignotarios SET nombre = REPLACE(nombre, 'Ã‘', 'ª');
            UPDATE u_pignotarios SET nombre = REPLACE(nombre, 'Â‘', 'ª');
            UPDATE u_pignotarios SET nombre = REPLACE(nombre, 'Ñ‘', 'ª'); 
            UPDATE u_pignotarios SET nombre = REPLACE(nombre, 'N‘', 'ª'); 
            
            UPDATE u_pignotarios SET nombre = REPLACE(nombre, 'ªª', 'º');             
            UPDATE u_pignotarios SET nombre = REPLACE(nombre, 'º', 'Ñ'); 


            SELECT * FROM `u_pignotarios` WHERE direccion LIKE "%‘%";           SON 404 REGISTROS
            UPDATE u_pignotarios SET direccion = REPLACE(direccion, 'ÃƒÂƒÃ‚', 'ª');
            UPDATE u_pignotarios SET direccion = REPLACE(direccion, 'ÃƒÂ‘', 'ª');
            UPDATE u_pignotarios SET direccion = REPLACE(direccion, 'Ã‚', 'ª'); 
            UPDATE u_pignotarios SET direccion = REPLACE(direccion, 'Â‘', 'ª'); 
            UPDATE u_pignotarios SET direccion = REPLACE(direccion, 'Ã‘', 'ª'); 
            UPDATE u_pignotarios SET direccion = REPLACE(direccion, 'ªª', 'ª'); 
            UPDATE u_pignotarios SET direccion = REPLACE(direccion, 'ª', 'Ñ'); 

            
            VSCRES51120420M500  ::: REPETIDO (13735 --> 21291)   
            SELECT * FROM u_pignotarios WHERE ife = 'VSCRES51120420M500'; 
            UPDATE u_pignotarios SET ife = 'VSCRES51120420M500_BORRAR' WHERE u_pignotarios.id = 13735 AND u_pignotarios.ife = 'VSCRES51120420M500'; 
            UPDATE u_pignotarios SET telefono = '9512096237' WHERE u_pignotarios.id = 21291 AND u_pignotarios.ife = 'VSCRES51120420M500'; 
            UPDATE h_t_boleta SET u_pignorante_id = 21291 WHERE u_pignorante_id = 13735; 
            UPDATE t_boleta SET u_pignorante_id = 21291 WHERE u_pignorante_id = 13735; 
            UPDATE t_empenios SET u_pignorante_id = 21291 WHERE u_pignorante_id = 13735; 
            UPDATE t_boleta_cancelado SET u_pignorante_id = 21291 WHERE u_pignorante_id = 13735; 
            
            MZCRMR86120120M300  ::: REPETIDO   (22870 --> 23996)
            SELECT * FROM u_pignotarios WHERE ife = 'MZCRMR86120120M300'; 
            UPDATE u_pignotarios SET ife = 'MZCRMR86120120M300_BORRAR' WHERE u_pignotarios.id = 22870 AND u_pignotarios.ife = 'MZCRMR86120120M300';  
            UPDATE h_t_boleta SET u_pignorante_id = 23996 WHERE u_pignorante_id = 22870; 
            UPDATE t_boleta SET u_pignorante_id = 23996 WHERE u_pignorante_id = 22870; 
            UPDATE t_empenios SET u_pignorante_id = 23996 WHERE u_pignorante_id = 22870; 
            UPDATE t_boleta_cancelado SET u_pignorante_id = 23996 WHERE u_pignorante_id = 22870;

            GRGRCC85041220M600  ::: REPETIDO (5641 --> 2879)
            SELECT * FROM u_pignotarios WHERE ife = 'GRGRCC85041220M600'; 
            UPDATE u_pignotarios SET ife = 'GRGRCC85041220M600_BORRAR' WHERE u_pignotarios.id = 5641 AND u_pignotarios.ife = 'GRGRCC85041220M600'; 
            UPDATE h_t_boleta SET u_pignorante_id = 2879 WHERE u_pignorante_id = 5641; 
            UPDATE t_boleta SET u_pignorante_id = 2879 WHERE u_pignorante_id = 5641; 
            UPDATE t_empenios SET u_pignorante_id = 2879 WHERE u_pignorante_id = 5641; 
            UPDATE t_boleta_cancelado SET u_pignorante_id = 2879 WHERE u_pignorante_id = 5641; 

            MRGRCR63081520M400  >>> Cp MUY LARGO
            SELECT * FROM u_pignotarios WHERE ife = 'MRGRCR63081520M400'; 
            UPDATE `u_pignotarios` SET `cp` = '68150' WHERE `u_pignotarios`.`id` = 28228 AND `u_pignotarios`.`ife` = 'MRGRCR63081520M400'; 

        */
        /* u_pignotarios_solidarios
            🔃 actualizamos todo a mayusculas, quitamos espacions dobles y eliminamos espacion en blanco al inicio y al final de los nombres
              UPDATE u_pignotarios_solidarios SET pignorante_solidario = UPPER(pignorante_solidario); 
              UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, '  ', ' '); 
              UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'NADIE', ''); 
              UPDATE u_pignotarios_solidarios SET pignorante_solidario = TRIM(pignorante_solidario); 

            >>> Revisamos los registros de pignorante_solidarios sean nombres invalidos, para ser eliminados
            ❌  SELECT pignorante_solidario, COUNT(t_boleta_id) FROM u_pignotarios_solidarios WHERE LENGTH(pignorante_solidario) < 9 GROUP BY pignorante_solidario; 
            DELETE FROM u_pignotarios_solidarios WHERE LENGTH(pignorante_solidario) < 9 ;
            ❌  SELECT DISTINCT pignorante_solidario FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '% DEJA%'; 
            DELETE FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '% DEJA%' AND LENGTH(pignorante_solidario) < 18;
            ❌  SELECT DISTINCT pignorante_solidario FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '% MIS%' AND LENGTH(pignorante_solidario) < 16; 
            DELETE FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '% MIS%' AND LENGTH(pignorante_solidario) < 16;
            ❌  SELECT DISTINCT pignorante_solidario FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '%EL M%' AND LENGTH(pignorante_solidario) < 12 
            DELETE FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '%EL M%' AND LENGTH(pignorante_solidario) < 12;  
            ❌  SELECT DISTINCT pignorante_solidario FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '%ELLA%' AND LENGTH(pignorante_solidario) < 15;
            DELETE FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '%ELLA%' AND LENGTH(pignorante_solidario) < 15;   
            ❌  SELECT DISTINCT pignorante_solidario FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '% MIXSMO %'; 
            DELETE FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '%MIXSMO%';  
            ❌  SELECT DISTINCT pignorante_solidario FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '% MISMO%'; 
            DELETE FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '% MISMO%'; 
            ❌  SELECT DISTINCT pignorante_solidario FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '% SOLA %' AND LENGTH(pignorante_solidario) < 12; 
            DELETE FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '%SOLA%' AND LENGTH(pignorante_solidario) < 12; 
            

            * 873 pignorantes solidarios con el nombre con caracteres invalidos
            SELECT * FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '%‘%';        
            
            UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'ÂƒÃƒÂƒÃ‚', 'ª');
            UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'ÃƒÂƒÃ‚', 'ª');
            ÂƒÃƒÂ‚
            ÃƒÂ‚
            Ã‚            
            Â‚
            ÃƒÂ‘
            Ã‘
            Â‘
            
            Ãƒª’ªª’  -> fallo
            Âƒª      -> fallo
            Ãª       -> fallo
            Âª
            ªÂ     -> fallo
            🔃  
                UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, '±', 'ª');
                UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, '†', 'ª');
                UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'Æ', 'ª');
                UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'ª‚', 'ª');
            SELECT * FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '%ª%';           

                UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'ª‘', 'ª');
                UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'ª’', 'ª');
                UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'ªª', 'º'); 
            SELECT * FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '%º%';
            🔃  UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'º', 'Ñ'); 
            
        */
        
        /* t_reposicion
            ~~En tabla t_reposicion el pignorante ya esta referenciado, SE ALMACENA EL ID
        */

        /* t_boleta, h_boleta y t_boleta_pagos
            
            >>> boleta con datos en null
                DELETE FROM t_boleta WHERE t_boleta.id = 10474068               
            >>> boleta con comision_avaluo numero muy largo (10604876)
                UPDATE t_boleta SET comision_avaluo = '1095.81' WHERE t_boleta.id = 10604876;       
            >>> boleta con comision_avaluo numero muy largo (1771886, 1786792)
                UPDATE h_t_boleta SET comision_avaluo = '1095.81' WHERE h_t_boleta.id_interno = 1771886; 
                UPDATE h_t_boleta SET comision_avaluo = '1095.81' WHERE h_t_boleta.id_interno = 1786792; 

            >>> Borramos 6356 registros de t_boleta_pagos que no existe relacion de 654 boletas en la tabla t_boleta 
                SELECT DISTINCT t_boleta_pagos.t_boleta_id 
                FROM t_boleta_pagos 
                LEFT JOIN t_boleta ON t_boleta_pagos.t_boleta_id = t_boleta.id 
                WHERE t_boleta.id IS null; 
            ❌ DELETE t_boleta_pagos 
                FROM t_boleta_pagos 
                LEFT JOIN t_boleta ON t_boleta_pagos.t_boleta_id = t_boleta.id 
                WHERE t_boleta.id IS null; 
            
            UPDATE h_t_boleta SET comision_avaluo = '109.581' WHERE comision_avaluo > 109581000; 
        */

        /* t_empenios_boleta_relacion, t_empenios, t_empenios_metal, t_empenios_productos


            >>> t_empenios :: se corrigue un error donde 4 registros de t_empenios no tiene un pignorante_id
            🔃  UPDATE t_empenios SET u_pignorante_id = 1933 WHERE u_pignorante_id = 27441 AND id IN (144879, 152894,152893,193264); 
            >>> Se corrigue un error donde el contenido de un productos no se guardo
            🔃  UPDATE t_empenios_productos SET contenido = '1' WHERE t_empenios_productos.id = 236634;

            >>> con esta consulta se encuentra el empeño repetido
            SELECT t_empenios.id, COUNT(t_empenios_boleta_relacion.t_empenios_id ) as connteo FROM t_empenios_boleta_relacion LEFT JOIN t_empenios ON t_empenios_boleta_relacion.t_empenios_id = t_empenios.id GROUP BY t_empenios.id ORDER by COUNT(t_empenios_boleta_relacion.t_empenios_id ) DESC; 
            >>> se encontro que el t_empenio_id:236634 se repite en las boletas: (10571943, 10575026), 
            >>> pero a la boleta 10575026 le corresponde el id: 236635 de acuerdo a la numeracion de empeño-boleta-relacion 
            >>> Sin embargo la boleta con el numero #10571943 no coincide los montos con el empeño 236634, por lo que se tiene que investigar a fondo que empeño es el correcto
            SELECT * FROM t_empenios_boleta_relacion LEFT JOIN t_empenios ON t_empenios_boleta_relacion.t_empenios_id = t_empenios.id WHERE t_empenios.id = 236634; 
            🔃  Con esta actualizacion se evita que se elimine por no tener realacion, pero los empeños siguen invertiddos
            UPDATE `t_empenios_boleta_relacion` SET `t_empenios_id` = '236635' WHERE `t_empenios_boleta_relacion`.`id` = 236634; 
            UPDATE `t_empenios_boleta_relacion` SET `t_empenios_id` = '236634' WHERE `t_empenios_boleta_relacion`.`id` = 236635; 
        
            >>> t_empenios_boleta_relacion :: verificamos las t_boleta_id que no existen en la tabla t_boletas (~825 registros)
             📌 SELECT DISTINCT t_empenios_boleta_relacion.t_boleta_id, t_empenios.id 
                    FROM t_empenios_boleta_relacion 
                    LEFT JOIN t_boleta ON t_empenios_boleta_relacion.t_boleta_id = t_boleta.id 
                    LEFT JOIN t_empenios ON t_empenios_boleta_relacion.t_empenios_id = t_empenios.id 
                    WHERE t_boleta.id IS NULL;
             ❌ DELETE t_empenios_boleta_relacion 
                    FROM t_empenios_boleta_relacion 
                    LEFT JOIN t_boleta ON t_empenios_boleta_relacion.t_boleta_id = t_boleta.id 
                    LEFT JOIN t_empenios ON t_empenios_boleta_relacion.t_empenios_id = t_empenios.id 
                    WHERE t_boleta.id IS NULL; 
            
            >>> t_empenios :: borramos los empeños que no tienen relacion t_empenios_boleta_relacion (~824 registros)
             📌 SELECT t_empenios.*
                 FROM    t_empenios
                 LEFT JOIN t_empenios_boleta_relacion ON t_empenios_boleta_relacion.t_empenios_id = t_empenios.id
                 WHERE t_empenios_boleta_relacion.id IS NULL;
             ❌ DELETE t_empenios 
                 FROM t_empenios 
                 LEFT JOIN t_empenios_boleta_relacion ON t_empenios_boleta_relacion.t_empenios_id = t_empenios.id
                 WHERE t_empenios_boleta_relacion.id IS NULL;

            >>> t_empenios_metal :: borramos los empeños que no tienen relacion t_empenios_boleta_relacion (~673 registros)
             📌 SELECT t_empenios_metal.* FROM t_empenios_metal 
              LEFT JOIN t_empenios ON t_empenios.id = t_empenios_metal.t_empenios_id WHERE t_empenios.id IS NULL;
             📌 SELECT t_empenios_metal.* FROM t_empenios_metal
                LEFT JOIN t_empenios_boleta_relacion ON t_empenios_boleta_relacion.t_empenios_id = t_empenios_metal.t_empenios_id
                WHERE t_empenios_boleta_relacion.id IS NULL;
             ❌ DELETE t_empenios_metal
                FROM    t_empenios_metal
                LEFT JOIN t_empenios_boleta_relacion ON t_empenios_boleta_relacion.t_empenios_id = t_empenios_metal.t_empenios_id
                WHERE t_empenios_boleta_relacion.id IS NULL;
            >>> t_empenios_productos :: borramos los empeños que no tienen relacion t_empenios_boleta_relacion (~114 registros)
             ❌ DELETE t_empenios_productos.*
                FROM    t_empenios_productos
                LEFT JOIN t_empenios_boleta_relacion ON t_empenios_boleta_relacion.t_empenios_id = t_empenios_productos.t_empenios_id
                WHERE t_empenios_boleta_relacion.id IS NULL;

        */

        /* t_control_interno
            >>> t_control_interno :: verificamos los registros que no tienen relacion con t_boleta    (1reg)
            SELECT *  FROM t_control_interno 
                LEFT JOIN t_boleta ON t_control_interno.t_boleta_id = t_boleta.id 
                WHERE t_boleta.id IS null; 
            ❌ DELETE t_control_interno  FROM t_control_interno 
                LEFT JOIN t_boleta ON t_control_interno.t_boleta_id = t_boleta.id 
                WHERE t_boleta.id IS null;
        */

        /* t_caja_monto_operador
            >>> t_caja_monto_operador :: las ventas en subasta, no guardan el id del operador en la tabla t_caja_monto_operador (20,801 registros)
                SELECT * FROM t_caja_monto_operador WHERE u_operadores_id = 0; 
             🔃 UPDATE t_caja_monto_operador SET u_operadores_id = 126 WHERE u_operadores_id = 0; 
            >>> t_caja_monto_operador :: Se corrigue un error donde el monto de la caja rebasa el valor permitido de 8 enteros y 2 decimales (2reg)
                SELECT * FROM t_caja_monto_operador WHERE caja > 100000000.00; 
             🔃 UPDATE t_caja_monto_operador SET caja = 1000000.00 WHERE caja > 99999999;
        */

        /* t_subasta y c_fecha_subasta
        
            DELETE FROM t_subasta WHERE `t_subasta`.`id` = 13739;

            //Se elimina el registro 407 porque tiene una fecha erronea
            DELETE FROM c_fecha_subasta WHERE id = 407;
            // el comprador del registro 6 no tiene nombre
            UPDATE `t_comprador` SET `nombre` = 'xxxx' WHERE `t_comprador`.`id` = 6;
        */
        /* t_comprador   y   t_compra_vitrina    
            UPDATE `t_comprador` SET `rfc` = null WHERE rfc = 'xxx'; 
            UPDATE `t_comprador` SET `rfc` = null WHERE rfc = ''; 

            UPDATE `t_comprador` SET `ife` = null WHERE ife = 'xxx'; 
            UPDATE `t_comprador` SET `ife` = null WHERE ife = ''; 

            UPDATE `t_comprador` SET `curp` = null WHERE curp = 'xxx'; 
            UPDATE `t_comprador` SET `curp` = null WHERE curp = ''; 

            id repetido = 3806(se conserva) <--- 3894(eliminamos)
            DELETE FROM t_comprador WHERE `t_comprador`.`id` = 3894;
            UPDATE t_compra_vitrina SET t_comprador_id = 3806 WHERE t_comprador_id = 3894; 
         
        */
        /* t_retasas
            //el id 3220 tiene t_boleta_id = 1 que es invalido
            DELETE FROM t_retasas WHERE `t_retasas`.`id` = 3220
        */
        /* t_concentrados
            // cambiar id_gerente e id_operador diferente de 0
            24885, 25123, 28282, 29703
            SELECT * FROM `t_concentrados` WHERE id_gerente = 0; 

            // todo da cero, mejor eliminamos
            DELETE FROM t_concentrados WHERE `t_concentrados`.`id` = 24885;

            SELECT * FROM `t_concentrados` WHERE id > 25120 LIMIT 10; 
            UPDATE `t_concentrados` SET `id_gerente` = '121' WHERE `t_concentrados`.`id` = 25123;  
            UPDATE `t_concentrados` SET `id_gerente` = '121' WHERE `t_concentrados`.`id` = 28282; 
            UPDATE `t_concentrados` SET `id_gerente` = '121' WHERE `t_concentrados`.`id` = 29703; 
        */
        /* t_compra_vitrina
            // el id 17161 tiene "cantidad" => 5.4714600912857E+15
            UPDATE `t_compra_vitrina` SET `cantidad` = '5610' WHERE `t_compra_vitrina`.`id` = 17161; 
            UPDATE `t_compra_vitrina` SET `cantidad` = '4995' WHERE `t_compra_vitrina`.`id` = 37160; 
            UPDATE `t_compra_vitrina` SET `cantidad` = '1200' WHERE `t_compra_vitrina`.`id` = 41161; 
            UPDATE `t_compra_vitrina` SET `cantidad` = '14742' WHERE `t_compra_vitrina`.`id` = 64178; 

            estos registros 23087, 31012 tienen t_boleta_id = null
            DELETE FROM `t_compra_vitrina` WHERE `t_boleta_id` is null;
            // el id 25380 tiene t_boleta_id = 352735 que no es valido
            DELETE FROM t_compra_vitrina WHERE `t_compra_vitrina`.`id` = 25380;

        */
        /* t_suspencion_dias
            >>> t_suspencion_dias :: se corrigue un error donde el id del operador no existe (862) y se cambia por 126
            UPDATE `t_suspencion_dias` SET `u_operadores_id` = 126 WHERE u_operadores_id = 862; 
        */
        /* t_num_tickes
            SELECT * FROM t_num_tickes LEFT JOIN t_boletas ON t_num_tickes.t_boleta_id = t_boletas.id WHERE t_boletas.id IS null; 
            2081 y 158375 no tienen t_boleta_id
            DELETE FROM t_num_tickes WHERE `t_num_tickes`.`id` = 2081;
            DELETE FROM t_num_tickes WHERE `t_num_tickes`.`id` = 158375;
        */
        /* OTRAS ANOMALIAS 
            >>> los pignorantes de t_boleta y t_empenios no coinciden (PORQUE???)
            SELECT * FROM `t_empenios_boleta_relacion` INNER JOIN t_boleta ON t_boleta.id = t_empenios_boleta_relacion.t_boleta_id INNER JOIN t_empenios ON t_empenios.id = t_empenios_boleta_relacion.t_empenios_id WHERE t_boleta.u_pignorante_id <> t_empenios.u_pignorante_id; 
         * 
        */
        /*  TERMINADA LA MIGRACION
            bash-4.4# mysql -u root -p
            mysql> exit
            # RESPALDO DE LA BASE DE DATOS SIEMP A UN ARCHIVO
                bash-4.4# mysqldump -u root -p siemp > /tmp/siemp_bkp_241210.sql
            # RESPALDO DE TODA LA BASE CON COMPRESION, PERO NO ESTA INSTALADO EN EL CONTENEDOR DE MYSQL
                bash-4.4# mysqldump -u root -p siemp | gzip > siemp_matriz.sql.gz
            # RESPALDO SELECTIVO DE TABLAS (NO CATALOGOS)
                bash-4.4# 
                    mysqldump -u root -p siemp users pignorantes t_boletas t_boleta_pagos t_empenios t_emp_bol_relations t_empenio_metals t_empenio_products t_ctrl_internos t_cajas h_boletas pignorante_solidarios > /tmp/siemp_bkp_no_cat_241211.sql
                    mysqldump -u root -p siemp users > /tmp/241208_siemp_users.sql
                    mysqldump -u root -p siemp pignorantes pignorante_solidarios > /tmp/241208_siemp_pigs.sql
                    mysqldump -u root -p siemp t_boletas t_empenios t_emp_bol_relations t_empenio_metals t_empenio_products > /tmp/241211_siemp_bol_emp_met_prods.sql
                    mysqldump -u root -p siemp t_boleta_pagos > /tmp/241211_siemp_pagos.sql
                    mysqldump -u root -p siemp t_ctrl_internos > /tmp/241211_siemp_ctrl_int.sql
                    mysqldump -u root -p siemp t_cajas > /tmp/241211_siemp_cajas.sql
                    mysqldump -u root -p siemp h_boletas > /tmp/241211_siemp_h_boleta.sql
            # desde el plugin de docker lo descargamos de la carpeta tmp a db_backups
            # desde el explorador de windows lo comprimimos 
        */
    }
    public function update($migration){

        switch ($migration){
            case 1:  $this->migraUsers(1);              break;
            case 2:  $this->migraPignorantes(2);        break;
            case 3:  $this->migraTBoleta(3);            break;
            case 4:  $this->migraTBoletaPagos(4);       break;
            case 5:  $this->migraTEmpenios(5);          break;
            case 6:  $this->migraTEmpBolRelation(6);    break;
            case 7:  $this->migraTEmpMetal(7);          break;
            case 8:  $this->migraTEmpProducts(8);       break;
            case 9:  $this->migraTCtrlInterno(9);       break;
            case 10: $this->migraTCajas(10);            break;
            case 11: $this->migraHBoleta(11);           break;
            case 12: $this->migraPig_Solidarios(12);    break;
            case 13: $this->migraPig_Solidarios(13);    break;
            case 14: $this->migraTSolDiasGracias(14);   break;
            case 15: $this->migraTSolAlmonedas(15);     break;
            case 16: $this->migraTSolSubastas(16);      break;
            case 17: $this->migraTSubastas(17);         break;
            case 18: $this->migraTSubastaFechas(18);    break;
            case 19: $this->migraTCompradores(19);      break;
            case 20: $this->migraTRetasas(20);          break;
            case 21: $this->migraTReposiciones(21);     break;
            case 22: $this->migraTConcentrados(22);     break;
            case 23: $this->migraTVitrinaVentas(23);    break;
            case 24: $this->migraTVitrinaCompras(24);   break;
            case 25: $this->migraTDemasiasPagadas(25);  break;
            case 26: $this->migraTSuspencionDias(26);   break;
            case 27: $this->migraTDescuentos(32);       break;
            case 28: $this->migraTTickets(33);          break;
            case 29: $this->migraTBoletaCancels(30);    break;
            case 30: $this->migraTCtrlIntCancels(31);   break;
            case 31: $this->migraRpt01Diario(27);       break;
            case 32: $this->migraRpt02Diario(28);       break;
            case 33: $this->migraRpt03Diario(29);       break;
            default: return to_route('migrations.index')->with('error', 'no existe tabla seleccionada');
        }
        
        return to_route('migrations.index');
    }
    private function migraUsers($table_selected){
        $status = '';
        $mesage = '';

        $dTable = $this->allTables[$table_selected]['destino'];

        $dRegistros_ids = DB::table($dTable)->distinct()->pluck('id');
        
        //todos los usuarios que estan registrados en u_operadores
        $oRegistros_ids = DB::connection('sucursal')->table('u_operadores')
                ->distinct()->pluck('id');

        // Todos los operadores que estan registrados en h_t_boleta
        // $oRegistros_ids = DB::connection('sucursal')->table('h_t_boleta')
        //     ->join('u_operadores', 'h_t_boleta.u_operador_id', '=', 'u_operadores.id')
        //     ->distinct()->pluck('u_operador_id');
            
        // Todos los operadores que estan registrados en t_boleta
        // $oRegistros_ids = DB::connection('sucursal')->table('t_boleta')
        //     ->join('u_operadores', 't_boleta.u_operador_id', '=', 'u_operadores.id')
        //     ->distinct()->pluck('u_operador_id');

        $ids_a_registrar = $oRegistros_ids->diff($dRegistros_ids);

        if($ids_a_registrar->count() > 0){
            $oRegistros = DB::connection('sucursal')->table('u_operadores')
                ->whereIn('u_operadores.id', $ids_a_registrar)
                ->get();
        
        
            $regsel = [];
            $databaseName = DB::connection()->getDatabaseName();

            DB::beginTransaction();
            try{
                foreach ($oRegistros as $registro) {
                    $num_sucursal = $registro->c_sucursal_id * 1000;
                    if($registro->rfc == ''){
                        $registro->rfc = $num_sucursal + $registro->id;
                    }

                    $regsel = [
                        'id'                => $registro->id,
                        'global_id'         => $num_sucursal + $registro->id,
                        'name'              => $registro->nombre,
                        'email'             => $registro->rfc.'@'.$registro->usuario,
                        'username'          => $registro->usuario,
                        'genero'            => $registro->genero == 2 ? 0 : 1,
                        // 'isSuper'           => $registro->isSuper,
                        // 'isAdmin'           => $registro->isAdmin,
                        'sede_id'           => $registro->c_sucursal_id,
                        'tenant_id'         => $databaseName,
                        // 'tema'              => $registro->tema,
                        'fecha_baja'        => $registro->fecha_fin_periodo == '2100-01-01' ? null : $registro->fecha_fin_periodo,
                        'password'          => $registro->password,
                        'created_at'        => $registro->fecha_ini_periodo,
                    ];
                    DB::table($dTable)->insert($regsel);
                }

        
                $status = 'success';
                $mesage = 'Registros migrados correctamente';

                DB::commit();
                    
            }catch(\Exception $e){
                DB::rollback();
                $status = 'error'; 
                $mesage = $e->getMessage();
                dd( $regsel,$mesage);
            }
        }else{
            $status = 'success';
            $mesage = 'Los usuarios ya han sido migrados';
        }

        $num_registros_origen = $this->allTables[$table_selected]['reg_o'];
        $num_registros_destino = DB::table($this->allTables[$table_selected]['destino'])->count();
        $avance = $num_registros_destino / $num_registros_origen * 100;
        Tables::where('id', $table_selected)->update([
            'num_registros_destino' => $num_registros_destino,
            'avance' => $avance
        ]);

        return redirect('migrations.index')->with($status, $mesage);
    }
    private function migraPignorantes($table_selected){
        $oTable = $this->allTables[$table_selected]['origen'];
        $dTable = $this->allTables[$table_selected]['destino'];

        $lastRecord = DB::table($dTable)->orderBy('id', 'desc')->first();

        if(!$lastRecord){
            $oRegistros = DB::connection('sucursal')->table($oTable)->limit(25000)->get();
        }else{
            $oRegistros = DB::connection('sucursal')->table($oTable)->where('id', '>', $lastRecord->id)->limit(25000)->get();
        }
        $regsel = [];
        $status = 'success';
        $mesage = 'Registros migrados correctamente';
        
        DB::beginTransaction();
        try{
            foreach ($oRegistros as $registro) 
            {
                if( preg_match('/[A-ZÑ&]{3,4}\d{6}[A-V1-9][A-Z1-9][0-9A]/', $registro->rfc) )
                    $rfc_validado = $registro->rfc;
                elseif( preg_match('/^[A-Za-z]{4}\d{6}/', $registro->rfc) )
                    $rfc_validado = $registro->rfc;
                elseif ( $registro->rfc=='' || strlen($registro->rfc) < 9 )
                    $rfc_validado = null;
                else
                    $rfc_validado = null;

                $telefono = null;
                $celular = null;
                if(!empty($registro->telefono)){

                    $telefonos = explode(',', $registro->telefono);

                    foreach($telefonos as $tel){
                        if(preg_match('/^\d{10}$/', $tel)){
                            if($celular == null)
                                $celular = $tel;
                            else
                                $celular .= ', '.$tel;
                        }else{
                            if($telefono == null)
                                $telefono = $tel;
                            else    
                                $telefono .= ', '.$tel;
                        }
                    }
                }
                //validamos el codigo postal sea un numero
                if(!is_numeric($registro->cp))
                    $registro->cp = 68000;
                

                $regsel = [
                    'id'                        => $registro->id,
                    'nombre'                    => $registro->nombre,
                    'ine'                       => $registro->ife,
                    'rfc'                       => $rfc_validado,
                    'celular'                   => $celular,
                    'telefono'                  => $telefono,
                    'email'                     => null,
                    'cp'                        => $registro->cp,
                    'estado_id'                 => $registro->estado_id,
                    'municipio_id'              => $registro->municipio_id,
                    'direccion'                 => $registro->direccion,
                    'identidad_frente'          => null,
                    'identidad_reverso'         => null,
                ];
                DB::table($dTable)->insert($regsel);
            }
            DB::commit();


        }catch(\Exception $e){
            DB::rollback();
            $status = 'error'; 
            $mesage = $e->getMessage();
            dd( $regsel,$mesage);
        }

        $num_registros_origen = $this->allTables[$table_selected]['reg_o'];
        $num_registros_destino = DB::table($this->allTables[$table_selected]['destino'])->count();
        $avance = $num_registros_destino / $num_registros_origen * 100;
        Tables::where('id', $table_selected)->update([
            'num_registros_destino' => $num_registros_destino,
            'avance' => $avance
        ]);

        return redirect('migrations.index')->with($status, $mesage);
    }
    private function migraTBoleta($table_selected){
        $oTable = $this->allTables[$table_selected]['origen'];
        $dTable = $this->allTables[$table_selected]['destino'];

        $lastRecord = DB::table($dTable)->orderBy('id', 'desc')->first();

        if(!$lastRecord){
            $oRegistros = DB::connection('sucursal')->table($oTable)->limit(50000)->get();
        }else{
            $oRegistros = DB::connection('sucursal')->table($oTable)->where('id', '>', $lastRecord->id)->limit(50000)->get();
        }
        $regsel = [];
        $status = 'success';
        $mesage = 'Registros migrados correctamente';
        
        DB::beginTransaction();
        try{
            $counter = 0;
            foreach ($oRegistros as $registro) {
                $regsel = [
                    'id'                    => $registro->id,
                    'prestamo'              => $registro->prestamo,
                    'avaluo'                => $registro->avaluo,
                    // 'interes'               => $registro->interes,
                    'recargo'               => $registro->recargo,
                    'abono'                 => $registro->abono,
                    'fecha_movimiento'      => $registro->fecha_movimiento,
                    'fecha_vencimiento'     => $registro->fecha_limite_pago,
                    'cat_status_empenio_id' => $registro->c_status_empenio_id,
                    'cat_operacion_tipo_id' => $registro->c_tipo_operacion_id,
                    'pignorante_id'         => $registro->u_pignorante_id,
                    'user_id'               => $registro->u_operador_id,
                    'tipo_empenio'          => $registro->c_tipo_producto_id,
                    'modificado'            => $registro->modificado,
                    'interes_vencido'       => $registro->interes_vencido,
                    'comision_almacenaje'   => $registro->comision_almacenaje,
                    'comision_avaluo'       => $registro->comision_avaluo,
                    'comision_almoneda'     => $registro->comision_almoneda,
                    'compuesto'             => $registro->compuesto,
                    'created_at'            => $registro->time_stamp =='0000-00-00 00:00:00' ? null : $registro->time_stamp,   
                ];
                DB::table($dTable)->insert($regsel);
                $counter++;

                if ($counter % 5000 == 0) {
                    DB::commit();
                    DB::beginTransaction();
                }
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $status = 'error'; 
            $mesage = $e->getMessage();
            dd( $regsel,$mesage);
        }

        $num_registros_origen = $this->allTables[$table_selected]['reg_o'];
        $num_registros_destino = DB::table($this->allTables[$table_selected]['destino'])->count();
        $avance = $num_registros_destino / $num_registros_origen * 100;
        Tables::where('id', $table_selected)->update([
            'num_registros_destino' => $num_registros_destino,
            'avance' => $avance
        ]);

        return redirect('migrations.index')->with($status, $mesage);
        
    }
    private function migraTBoletaPagos($table_selected){
        $oTable = $this->allTables[$table_selected]['origen'];
        $dTable = $this->allTables[$table_selected]['destino'];

        $lastRecord = DB::table($dTable)->orderBy('id', 'desc')->first();

        if(!$lastRecord){
            $oRegistros = DB::connection('sucursal')->table($oTable)->orderBy('id', 'asc')->limit(80000)->get();
        }else{
            $oRegistros = DB::connection('sucursal')->table($oTable)->where('id', '>', $lastRecord->id)->orderBy('id', 'asc')->limit(80000)->get();
        }
        $regsel = [];
        $status = 'success';
        $mesage = 'Registros migrados correctamente';
        
        DB::beginTransaction();
        try{
            $counter = 0;
            foreach ($oRegistros as $registro) {
                $regsel = [
                    'id'                    => $registro->id,
                    'num_pago'              => $registro->num_pago,
                    'fecha_pago'            => $registro->fecha_pago,
                    'prestamo'              => $registro->monto,
                    'refrendo'              => $registro->interes,
                    'capital_mas_interes'   => $registro->capital_mas_interes,
                    't_boleta_id'           => $registro->t_boleta_id,
                ];
                DB::table($dTable)->insert($regsel);
                $counter++;

                if ($counter % 5000 == 0) {
                    DB::commit();
                    DB::beginTransaction();
                }
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $status = 'error'; 
            $mesage = $e->getMessage();
            dd($regsel, $mesage);
        }

        $num_registros_origen = $this->allTables[$table_selected]['reg_o'];
        $num_registros_destino = DB::table($this->allTables[$table_selected]['destino'])->count();
        $avance = $num_registros_destino / $num_registros_origen * 100;
        Tables::where('id', $table_selected)->update([
            'num_registros_destino' => $num_registros_destino,
            'avance' => $avance
        ]);

        return redirect('migrations.index')->with($status, $mesage);
    }
    private function migraTEmpenios($table_selected){
        $oTable = $this->allTables[$table_selected]['origen'];
        $dTable = $this->allTables[$table_selected]['destino'];

        
            $lastRecord = DB::table($dTable)->orderBy('id', 'desc')->first();

            if(!$lastRecord){
                $oRegistros = DB::connection('sucursal')->table($oTable)->orderBy('id', 'asc')->limit(50000)->get();
            }else{
                $oRegistros = DB::connection('sucursal')->table($oTable)->where('id', '>', $lastRecord->id)->orderBy('id', 'asc')->limit(50000)->get();
            }
            $regsel = [];
            $status = 'success';
            $mesage = 'Registros migrados correctamente';
            
            DB::beginTransaction();
            try{
                $counter = 0;
                foreach ($oRegistros as $registro) {
                    $regsel = [
                        'id'                    => $registro->id,
                        'avaluo'                => $registro->valuo,
                        'prestamo'              => $registro->prestamo,
                        'maximo'                => $registro->maximo,
                        'minimo'                => $registro->minimo,
                        'cat_status_empenio_id' => $registro->c_status_empenio_id,
                        'cat_prestamo_tipo_id'  => $registro->c_tipo_prestamo,
                        'pignorante_id'         => $registro->u_pignorante_id,
                        'cat_product_sub_id'    => $registro->c_sub_productos_id,
                    ];
                    DB::table($dTable)->insert($regsel);
                    $counter++;

                    if ($counter % 5000 == 0) {
                        DB::commit();
                        DB::beginTransaction();
                    }
                }
                DB::commit();
            }catch(\Exception $e){
                DB::rollback();
                $status = 'error'; 
                $mesage = $e->getMessage();
                dd( $regsel,$mesage);
            }
            

        $num_registros_origen = $this->allTables[$table_selected]['reg_o'];
        $num_registros_destino = DB::table($this->allTables[$table_selected]['destino'])->count();
        $avance = $num_registros_destino / $num_registros_origen * 100;
            Tables::where('id', $table_selected)->update([
                'num_registros_destino' => $num_registros_destino,
                'avance' => $avance
            ]);

        return redirect('migrations.index')->with($status, $mesage);
    }
    private function migraTEmpBolRelation($table_selected){
        $oTable = $this->allTables[$table_selected]['origen'];
        $dTable = $this->allTables[$table_selected]['destino'];

        $lastRecord = DB::table($dTable)->orderBy('id', 'desc')->first();

        if(!$lastRecord){
            $oRegistros = DB::connection('sucursal')->table($oTable)->limit(80000)->get();
        }else{
            $oRegistros = DB::connection('sucursal')->table($oTable)->where('id', '>', $lastRecord->id)->limit(80000)->get();
        }
        $regsel = [];
        $status = 'success';
        $mesage = 'Registros migrados correctamente';
        
        DB::beginTransaction();
        try{
            $counter = 0;
            foreach ($oRegistros as $registro) {
                $regsel = [
                    'id'            => $registro->id,
                    't_empenio_id' => $registro->t_empenios_id,
                    't_boleta_id'  => $registro->t_boleta_id,
                ];
                DB::table($dTable)->insert($regsel);
                $counter++;

                if ($counter % 5000 == 0) {
                    DB::commit();
                    DB::beginTransaction();
                }
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $status = 'error'; 
            $mesage = $e->getMessage();
            dd( $regsel,$mesage);
        }

        $num_registros_origen = $this->allTables[$table_selected]['reg_o'];
        $num_registros_destino = DB::table($this->allTables[$table_selected]['destino'])->count();
        $avance = $num_registros_destino / $num_registros_origen * 100;
        Tables::where('id', $table_selected)->update([
            'num_registros_destino' => $num_registros_destino,
            'avance' => $avance
        ]);

        return redirect('migrations.index')->with($status, $mesage);
    }
    private function migraTEmpMetal($table_selected){
        $oTable = $this->allTables[$table_selected]['origen'];
        $dTable = $this->allTables[$table_selected]['destino'];

        $lastRecord = DB::table($dTable)->orderBy('id', 'desc')->first();

        if(!$lastRecord){
            $oRegistros = DB::connection('sucursal')->table($oTable)->orderBy('id','asc')->limit(80000)->get();
        }else{
            $oRegistros = DB::connection('sucursal')->table($oTable)->where('id', '>', $lastRecord->id)->orderBy('id','asc')->limit(80000)->get();
        }
        $regsel = [];
        $status = 'success';
        $mesage = 'Registros migrados correctamente';
        
        DB::beginTransaction();
        try{
            $counter = 0;
            foreach ($oRegistros as $registro) {
                $regsel = [
                    'id'                    => $registro->id,
                    'descripcion'           => $registro->descripcion,
                    'peso'                  => $registro->peso,
                    'pesoTotal'             => $registro->pesoTotal,
                    't_empenio_id'         => $registro->t_empenios_id,
                    'cat_metal_cotiza_id'   => $registro->c_cotiza_metales_id,
                ];
                DB::table($dTable)->insert($regsel);
                $counter++;

                if ($counter % 5000 == 0) {
                    DB::commit();
                    DB::beginTransaction();
                }
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $status = 'error'; 
            $mesage = $e->getMessage();
            dd( $regsel,$mesage);
        }

        $num_registros_origen = $this->allTables[$table_selected]['reg_o'];
        $num_registros_destino = DB::table($this->allTables[$table_selected]['destino'])->count();
        $avance = $num_registros_destino / $num_registros_origen * 100;
        Tables::where('id', $table_selected)->update([
            'num_registros_destino' => $num_registros_destino,
            'avance' => $avance
        ]);

        return redirect('migrations.index')->with($status, $mesage);
    }
    private function migraTEmpProducts($table_selected){
        $oTable = $this->allTables[$table_selected]['origen'];
        $dTable = $this->allTables[$table_selected]['destino'];

        $lastRecord = DB::table($dTable)->orderBy('id', 'desc')->first();

        if(!$lastRecord){
            $oRegistros = DB::connection('sucursal')->table($oTable)->orderBy('id','asc')->limit(50000)->get();
        }else{
            $oRegistros = DB::connection('sucursal')->table($oTable)->where('id', '>', $lastRecord->id)->orderBy('id','asc')->limit(50000)->get();
        }
        $regsel = [];
        $status = 'success';
        $mesage = 'Registros migrados correctamente';
        
        DB::beginTransaction();
        try{
            $counter = 0;
            foreach ($oRegistros as $registro) {
                $regsel = [
                    'id'            => $registro->id,
                    'contenido'     => $registro->contenido,
                    'descripcion'   => $registro->descripcion,
                    'marca'         => $registro->marca,
                    'serie'         => $registro->serie,
                    't_empenio_id' => $registro->t_empenios_id,
                ];
                DB::table($dTable)->insert($regsel);
                $counter++;

                if ($counter % 5000 == 0) {
                    DB::commit();
                    DB::beginTransaction();
                }
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $status = 'error'; 
            $mesage = $e->getMessage();
            dd( $regsel,$mesage);
        }

        $num_registros_origen = $this->allTables[$table_selected]['reg_o'];
        $num_registros_destino = DB::table($this->allTables[$table_selected]['destino'])->count();
        $avance = $num_registros_destino / $num_registros_origen * 100;
        Tables::where('id', $table_selected)->update([
            'num_registros_destino' => $num_registros_destino,
            'avance' => $avance
        ]);

        return redirect('migrations.index')->with($status, $mesage);
    }
    private function migraTCtrlInterno($table_selected){
        $oTable = $this->allTables[$table_selected]['origen'];
        $dTable = $this->allTables[$table_selected]['destino'];

        $lastRecord = DB::table($dTable)->orderBy('id', 'desc')->first();

        if(!$lastRecord){
            $oRegistros = DB::connection('sucursal')->table($oTable)->orderBy('id_interno','asc')->limit(80000)->get();
        }else{
            $oRegistros = DB::connection('sucursal')->table($oTable)->where('id_interno', '>', $lastRecord->id)->orderBy('id_interno','asc')->limit(80000)->get();
        }
        $regsel = [];
        $status = 'success';
        $mesage = 'Registros migrados correctamente';
        
        DB::beginTransaction();
        try{
            $counter = 0;
            foreach ($oRegistros as $registro) {
                $regsel = [
                    'id'            => $registro->id_interno,
                    'letra'         => $registro->letra,
                    'numero'        => $registro->numero_interno,
                    't_boleta_id'  => $registro->t_boleta_id,
                    'fecha'         => $registro->fecha,
                    'hora'          => $registro->hora,
                ];
                DB::table($dTable)->insert($regsel);
                $counter++;

                if ($counter % 5000 == 0) {
                    DB::commit();
                    DB::beginTransaction();
                }
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $status = 'error'; 
            $mesage = $e->getMessage();
            dd( $regsel,$mesage);
        }

        $num_registros_origen = $this->allTables[$table_selected]['reg_o'];
        $num_registros_destino = DB::table($this->allTables[$table_selected]['destino'])->count();
        $avance = $num_registros_destino / $num_registros_origen * 100;
        Tables::where('id', $table_selected)->update([
            'num_registros_destino' => $num_registros_destino,
            'avance' => $avance
        ]);

        return redirect('migrations.index')->with($status, $mesage);
    }
    private function migraTCajas($table_selected){
        $oTable = $this->allTables[$table_selected]['origen'];
        $dTable = $this->allTables[$table_selected]['destino'];

        $lastRecord = DB::table($dTable)->orderBy('id', 'desc')->first();

        if(!$lastRecord){
            $oRegistros = DB::connection('sucursal')->table($oTable)->orderBy('id','asc')->limit(60000)->get();
        }else{
            $oRegistros = DB::connection('sucursal')->table($oTable)->where('id', '>', $lastRecord->id)->orderBy('id','asc')->limit(60000)->get();
        }
        $regsel = [];
        $status = 'success';
        $mesage = 'Registros migrados correctamente';
        
        DB::beginTransaction();
        try{
            $counter = 0;
            foreach ($oRegistros as $registro) {
                $regsel = [
                    'id'            => $registro->id,
                    'fecha'         => $registro->fecha,
                    'caja'          => $registro->caja,
                    'abono_caja'    => $registro->abono_caja,
                    'empenios'      => $registro->empenios,
                    'refrendos'     => $registro->refrendos,
                    'abonos'        => $registro->abonos,
                    'desempenios'   => $registro->desempenios,
                    'duplicado'     => $registro->duplicado,
                    'venta_subasta' => $registro->venta_subasta,
                    'venta_vitrina' => $registro->venta_vitrina,
                    'consolidados'  => $registro->consolidados,
                    't_boleta_id'  => $registro->t_boleta_id,
                    // 'total_egresos' => $registro->total_egresos,
                    // 'total'         => $registro->total,
                    'user_id'       => $registro->u_operadores_id??126,
                ];
                DB::table($dTable)->insert($regsel);
                $counter++;

                if ($counter % 5000 == 0) {
                    DB::commit();
                    DB::beginTransaction();
                }
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $status = 'error'; 
            $mesage = $e->getMessage();
            dd( $regsel,$mesage);
        }

        $num_registros_origen = $this->allTables[$table_selected]['reg_o'];
        $num_registros_destino = DB::table($this->allTables[$table_selected]['destino'])->count();
        $avance = $num_registros_destino / $num_registros_origen * 100;
        Tables::where('id', $table_selected)->update([
            'num_registros_destino' => $num_registros_destino,
            'avance' => $avance
        ]);

        return redirect('migrations.index')->with($status, $mesage);
    }
    private function migraHBoleta($table_selected){
        $oTable = $this->allTables[$table_selected]['origen'];
        $dTable = $this->allTables[$table_selected]['destino'];

        $lastRecord = DB::table($dTable)->orderBy('id', 'desc')->first();

        if(!$lastRecord){
            $oRegistros = DB::connection('sucursal')->table($oTable)->orderBy('id_interno','asc')->limit(50000)->get();
        }else{
            $oRegistros = DB::connection('sucursal')->table($oTable)->where('id_interno', '>', $lastRecord->id)->orderBy('id_interno','asc')->limit(50000)->get();
        }
        $regsel = [];
        $status = 'success';
        $mesage = 'Registros migrados correctamente';
        
        DB::beginTransaction();
        try{
            $counter = 0;
            foreach ($oRegistros as $registro) {
                $regsel = [
                    'id'                    => $registro->id_interno,
                    't_boleta_id'          => $registro->id,
                    'prestamo'              => $registro->prestamo,
                    'avaluo'                => $registro->avaluo,
                    // 'interes'               => $registro->interes,
                    'recargo'               => $registro->recargo,
                    'abono'                 => $registro->abono,
                    'fecha_movimiento'      => $registro->fecha_movimiento,
                    'fecha_vencimiento'     => $registro->fecha_limite_pago,
                    'cat_status_empenio_id' => $registro->c_status_empenio_id,
                    'cat_operacion_tipo_id' => $registro->c_tipo_operacion_id,
                    'pignorante_id'         => $registro->u_pignorante_id,
                    'user_id'               => $registro->u_operador_id??101,
                    'tipo_empenio'          => $registro->c_tipo_producto_id,
                    'modificado'            => $registro->modificado,
                    'interes_vencido'       => $registro->interes_vencido,
                    'comision_almacenaje'   => $registro->comision_almacenaje,
                    'comision_avaluo'       => $registro->comision_avaluo,
                    'comision_almoneda'     => $registro->comision_almoneda,
                    'compuesto'             => $registro->compuesto,
                    'created_at'            => $registro->time_stamp =='0000-00-00 00:00:00' ? null : $registro->time_stamp,   
                ];
                DB::table($dTable)->insert($regsel);
                $counter++;

                if ($counter % 5000 == 0) {
                    DB::commit();
                    DB::beginTransaction();
                }
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $status = 'error'; 
            $mesage = $e->getMessage();
            dd( $regsel,$mesage);
        }

        $num_registros_origen = $this->allTables[$table_selected]['reg_o'];
        $num_registros_destino = DB::table($this->allTables[$table_selected]['destino'])->count();
        $avance = $num_registros_destino / $num_registros_origen * 100;
        Tables::where('id', $table_selected)->update([
            'num_registros_destino' => $num_registros_destino,
            'avance' => $avance
        ]);

        return redirect('migrations.index')->with($status, $mesage);
    }
    private function migraPig_Solidarios($table_selected){
        
        $regsel = [];
        $status = 'success';
        $mesage = 'Registros migrados correctamente';

        $oTable = $this->allTables[$table_selected]['origen'];
        $dTable = $this->allTables[$table_selected]['destino'];

        $lastRecord = DB::table($dTable)->orderBy('id', 'desc')->first();

        if(!$lastRecord){
            $oRegistros = DB::connection('sucursal')->table($oTable)->distinct()
                ->select('t_boleta.u_pignorante_id','u_pignotarios_solidarios.pignorante_solidario')
                ->join('t_boleta','t_boleta.id','=','u_pignotarios_solidarios.t_boleta_id')
                ->where('t_boleta.u_pignorante_id', '<', 1000)
                ->orderBy('t_boleta.u_pignorante_id','asc')   
                ->orderBy('u_pignotarios_solidarios.pignorante_solidario')   
                ->get();
        }else{
            $oRegistros = DB::connection('sucursal')->table($oTable)->distinct()
            ->select('t_boleta.u_pignorante_id','u_pignotarios_solidarios.pignorante_solidario')
            ->join('t_boleta','t_boleta.id','=','u_pignotarios_solidarios.t_boleta_id')
            ->whereBetween('u_pignorante_id', [$lastRecord->pignorante_id + 1, $lastRecord->pignorante_id + 4000])
            ->orderBy('t_boleta.u_pignorante_id','asc')
            ->orderBy('u_pignotarios_solidarios.pignorante_solidario')   
            ->get();

        }

        // El resultado real de $listaPigSolidarios en de 31,829 registros,
        // pero al realizar el pluck los registros bajan a 30,092, que equivalen a 1,737 registros menos; 
        // debido a que la llave del pluck(pignorante_solidario) solo mantiene 1 nombre parecido
        // lo ideal es usar el metodo get() para obtener todos los registros
 
        if($oRegistros->count()){
            DB::beginTransaction();
            try{
                foreach($oRegistros as $pignorante)   {               
                    $regsel = [
                        'nombre'                => $pignorante->pignorante_solidario,
                        'contacto'              => '',
                        'parentesco'            => '',
                        'pignorante_id'        => $pignorante->u_pignorante_id,
                    ];
                    DB::table($dTable)->insert($regsel);
                }
                DB::commit();
            }catch(\Exception $e){
                DB::rollback();
                $status = 'error'; 
                $mesage = $e->getMessage();
                dd( $regsel,$mesage);
            }
        }else{
           
            $lastTBoleta = DB::table('t_boletas')->whereNotNull('pignorante_solidario_id')->orderBy('pignorante_id', 'desc')->first();

            if(!$lastTBoleta)
                $PSolidarios = DB::table('pignorante_solidarios')
                                 ->orderBy('pignorante_id','asc')
                                 ->where('pignorante_id', '<', 1000)
                                 ->get();
            else
                $PSolidarios = DB::table('pignorante_solidarios')
                                 ->whereBetween('pignorante_id', [$lastTBoleta->pignorante_id + 1, $lastTBoleta->pignorante_id + 1000])
                                 ->orderBy('pignorante_id','asc')
                                 ->get();

            DB::beginTransaction();
            try{
                $counter = 0;

                foreach($PSolidarios as $PSolidario)
                { 
                    $created_at = null;
                    $updated_at = null;
                    $boletasSolidarios = DB::connection('sucursal')->table($oTable)->select(
                                        'u_pignotarios_solidarios.t_boleta_id',
                                        'u_pignotarios_solidarios.pignorante_solidario',
                                        'u_pignotarios_solidarios.fecha_registro',
                                        't_boleta.u_pignorante_id')
                                        ->join('t_boleta','t_boleta.id','=','u_pignotarios_solidarios.t_boleta_id')
                                        ->where('pignorante_solidario', $PSolidario->nombre)
                                        ->where('t_boleta.u_pignorante_id', $PSolidario->pignorante_id)
                                        ->orderBy('t_boleta_id', 'asc')
                                        ->get();
                    foreach($boletasSolidarios as $boletaSolidario)
                    {
                        TBoleta::where('id', $boletaSolidario->t_boleta_id)->update([
                            'pignorante_solidario_id' => $PSolidario->id,
                        ]);
                        
                        $updated_at = $boletaSolidario->fecha_registro;
                        if($created_at == null)
                            $created_at = $boletaSolidario->fecha_registro;
                    }
                    // $pignoranteList = array_unique($pignoranteList);
                    // if (count($pignoranteList) > 1) {
                    //     Log::info('El pignorante solidario:'.$boletaSolidario->pignorante_solidario.' tiene dos pignorantes diferentes:', $pignoranteList);
                    // }

                    PignoranteSolidario::where('id', $PSolidario->id)->update([
                            'created_at' => $created_at,
                            'updated_at' => $updated_at,
                        ]);
    
                    $counter++;
                    if ($counter % 100 == 0) {
                        DB::commit();
                        DB::beginTransaction();
                    }
                }
                DB::commit();
            }catch(\Exception $e){
                DB::rollback();
                $status = 'error'; 
                $mesage = $e->getMessage();
                dd($mesage);
            }
        }

        $num_registros_origen = $this->allTables[$table_selected]['reg_o'];
        if($table_selected == 12){
            $num_registros_destino = DB::table($this->allTables[$table_selected]['destino'])->count();
            
        }else{
            $num_registros_destino = DB::table('t_boletas')->whereNotNull('pignorante_solidario_id')->count();
        }
        $avance = $num_registros_destino / $num_registros_origen * 100;
        Tables::where('id', $table_selected)->update([
            'num_registros_destino' => $num_registros_destino,
            'avance' => $avance
        ]);
        return redirect('migrations.index')->with($status, $mesage);
    }
    private function migraTSolDiasGracias($table_selected){
        $oTable = $this->allTables[$table_selected]['origen'];
        $dTable = $this->allTables[$table_selected]['destino'];

        $lastRecord = DB::table($dTable)->orderBy('id', 'desc')->first();

        if(!$lastRecord){
            $oRegistros = DB::connection('sucursal')->table($oTable)->orderBy('id_reg','asc')->limit(50000)->get();
        }else{
            $oRegistros = DB::connection('sucursal')->table($oTable)->where('id_reg', '>', $lastRecord->id)->orderBy('id_reg','asc')->limit(50000)->get();
        }
        $regsel = [];
        $status = 'success';
        $mesage = 'Registros migrados correctamente';
        
        DB::beginTransaction();
        try{
            $counter = 0;
            foreach ($oRegistros as $registro) {
                $regsel = [
                    'id'            => $registro->id_reg,
                    't_boleta_id'  => $registro->id,
                    'fecha_movimiento'  => $registro->fecha_movimiento,
                    'fecha_vencimiento'=> $registro->fecha_vencimiento,
                    'tipo_empenio' => $registro->tipo_producto,
                    'dias_gracia' => $registro->dias_gracia,
                    'prestamo' => $registro->prestamo,
                ];
                DB::table($dTable)->insert($regsel);
                $counter++;

                if ($counter % 5000 == 0) {
                    DB::commit();
                    DB::beginTransaction();
                }
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $status = 'error'; 
            $mesage = $e->getMessage();
            dd( $regsel,$mesage);
        }

        $num_registros_origen = $this->allTables[$table_selected]['reg_o'];
        $num_registros_destino = DB::table($this->allTables[$table_selected]['destino'])->count();
        $avance = $num_registros_destino / $num_registros_origen * 100;
        Tables::where('id', $table_selected)->update([
            'num_registros_destino' => $num_registros_destino,
            'avance' => $avance
        ]);

        return redirect('migrations.index')->with($status, $mesage);
    }
    private function migraTSolAlmonedas($table_selected){
        $oTable = $this->allTables[$table_selected]['origen'];
        $dTable = $this->allTables[$table_selected]['destino'];

        $lastRecord = DB::table($dTable)->orderBy('id', 'desc')->first();

        if(!$lastRecord){
            $oRegistros = DB::connection('sucursal')->table($oTable)->orderBy('id_reg','asc')->limit(50000)->get();
        }else{
            $oRegistros = DB::connection('sucursal')->table($oTable)->where('id_reg', '>', $lastRecord->id)->orderBy('id_reg','asc')->limit(50000)->get();
        }
        $regsel = [];
        $status = 'success';
        $mesage = 'Registros migrados correctamente';
        
        DB::beginTransaction();
        try{
            $counter = 0;
            foreach ($oRegistros as $registro) {
                $regsel = [
                    'id'            => $registro->id_reg,
                    't_boleta_id'   => $registro->id,
                    'fecha_movimiento'  => $registro->fecha_movimiento,
                    'fecha_vencimiento' => $registro->fecha_vencimiento,
                    'capital'   => $registro->capital,
                    'avaluo'    => $registro->avaluo,
                    'tipo_empenio'  => $registro->tipo_producto,
                    // 'partida'   => $registro->partida,                   //SIN DATOS EN BD
                    // 'ultima_operacion'  => $registro->ultima_operacion, //SIN DATOS EN BD

                ];
                DB::table($dTable)->insert($regsel);
                $counter++;

                if ($counter % 5000 == 0) {
                    DB::commit();
                    DB::beginTransaction();
                }
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $status = 'error'; 
            $mesage = $e->getMessage();
            dd( $regsel,$mesage);
        }

        $num_registros_origen = $this->allTables[$table_selected]['reg_o'];
        $num_registros_destino = DB::table($this->allTables[$table_selected]['destino'])->count();
        $avance = $num_registros_destino / $num_registros_origen * 100;
        Tables::where('id', $table_selected)->update([
            'num_registros_destino' => $num_registros_destino,
            'avance' => $avance
        ]);

        return redirect('migrations.index')->with($status, $mesage);
    }
    private function migraTSolSubastas($table_selected){
        $oTable = $this->allTables[$table_selected]['origen'];
        $dTable = $this->allTables[$table_selected]['destino'];

        $lastRecord = DB::table($dTable)->orderBy('id', 'desc')->first();

        if(!$lastRecord){
            $oRegistros = DB::connection('sucursal')->table($oTable)->orderBy('id_reg','asc')->limit(50000)->get();
        }else{
            $oRegistros = DB::connection('sucursal')->table($oTable)->where('id_reg', '>', $lastRecord->id)->orderBy('id_reg','asc')->limit(50000)->get();
        }
        $regsel = [];
        $status = 'success';
        $mesage = 'Registros migrados correctamente';
        
        DB::beginTransaction();
        try{
            $counter = 0;
            foreach ($oRegistros as $registro) {
                $regsel = [
                    'id'            => $registro->id_reg,
                    't_boleta_id'   => $registro->id,
                    'fecha_subasta' => $registro->fecha_subasta,
                    'capital'       => $registro->capital,
                    'avaluo'        => $registro->avaluo,
                    'tipo_empenio'  => $registro->tipo_producto,

                ];
                DB::table($dTable)->insert($regsel);
                $counter++;

                if ($counter % 5000 == 0) {
                    DB::commit();
                    DB::beginTransaction();
                }
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $status = 'error'; 
            $mesage = $e->getMessage();
            dd( $regsel,$mesage);
        }

        $num_registros_origen = $this->allTables[$table_selected]['reg_o'];
        $num_registros_destino = DB::table($this->allTables[$table_selected]['destino'])->count();
        $avance = $num_registros_destino / $num_registros_origen * 100;
        Tables::where('id', $table_selected)->update([
            'num_registros_destino' => $num_registros_destino,
            'avance' => $avance
        ]);

        return redirect('migrations.index')->with($status, $mesage);
    }
    private function migraTSubastas($table_selected){
        $oTable = $this->allTables[$table_selected]['origen'];
        $dTable = $this->allTables[$table_selected]['destino'];
        
        $lastRecord = DB::table($dTable)->orderBy('id', 'desc')->first();

        if(!$lastRecord){
            $oRegistros = DB::connection('sucursal')->table($oTable)->orderBy('id','asc')->limit(40000)->get();
        }else{
            $oRegistros = DB::connection('sucursal')->table($oTable)->where('id', '>', $lastRecord->id)->orderBy('id','asc')->limit(40000)->get();
        }
        $regsel = [];
        $status = 'success';
        $mesage = 'Registros migrados correctamente';
        
        DB::beginTransaction();
        try{
            $counter = 0;
            foreach ($oRegistros as $registro) {
                $regsel = [
                    'id'                    => $registro->id,
                    't_subasta_fecha_id'    => $registro->c_fecha_subasta_id,
                    'cat_status_subasta_id' => $registro->c_status_subasta_id,
                    't_boleta_id'           => $registro->t_boleta_id,
                    'precio_sugerido'       => $registro->precio_sugerido,
                    'precio_venta_subasta'  => $registro->precio_venta_subasta,
                ];
                DB::table($dTable)->insert($regsel);
                $counter++;

                if ($counter % 500 == 0) {
                    DB::commit();
                    DB::beginTransaction();
                }
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $status = 'error'; 
            $mesage = $e->getMessage();
            dd($regsel,$mesage);
        }

        $num_registros_origen = $this->allTables[$table_selected]['reg_o'];
        $num_registros_destino = DB::table($this->allTables[$table_selected]['destino'])->count();
        $avance = $num_registros_destino / $num_registros_origen * 100;
        Tables::where('id', $table_selected)->update([
            'num_registros_destino' => $num_registros_destino,
            'avance' => $avance
        ]);

        return redirect('migrations.index')->with($status, $mesage);
    }
    private function migraTSubastaFechas($table_selected){
        $oTable = $this->allTables[$table_selected]['origen'];
        $dTable = $this->allTables[$table_selected]['destino'];
        
        $lastRecord = DB::table($dTable)->orderBy('id', 'desc')->first();

        if(!$lastRecord){
            $oRegistros = DB::connection('sucursal')->table($oTable)->orderBy('id','asc')->limit(1000)->get();
        }else{
            $oRegistros = DB::connection('sucursal')->table($oTable)->where('id', '>', $lastRecord->id)->orderBy('id','asc')->limit(1000)->get();
        }
        $regsel = [];
        $status = 'success';
        $mesage = 'Registros migrados correctamente';
        
        DB::beginTransaction();
        try{
            $counter = 0;
            foreach ($oRegistros as $registro) {
                $regsel = [
                    'id'                    => $registro->id,
                    'fecha_subasta'         => $registro->fecha_subasta,
                    'visible'               => $registro->visible,
                    'tipo_empenio'          => $registro->c_tipo_subasta,
                    'cat_status_subasta_id' => $registro->c_status_subasta_id,
                    'capital'               => $registro->capital,
                    'intNormal'             => $registro->intNormal,
                    'intVencido'            => $registro->intVencido,
                    'intAvaluo'             => $registro->intAvaluo,
                    'abonos'                => $registro->abonos,
                    'totalVenta'            => $registro->totalVenta,
                    'comisionVenta'         => $registro->comisionVenta,
                    'demasia'               => $registro->demasia,
                    'numReg'                => $registro->numReg,
                    'adm_sede_id'           => $registro->c_sucursal_id,
                ];
                DB::table($dTable)->insert($regsel);
                $counter++;

                if ($counter % 5000 == 0) {
                    DB::commit();
                    DB::beginTransaction();
                }
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $status = 'error'; 
            $mesage = $e->getMessage();
            dd($regsel,$mesage);
        }

        $num_registros_origen = $this->allTables[$table_selected]['reg_o'];
        $num_registros_destino = DB::table($this->allTables[$table_selected]['destino'])->count();
        $avance = $num_registros_destino / $num_registros_origen * 100;
        Tables::where('id', $table_selected)->update([
            'num_registros_destino' => $num_registros_destino,
            'avance' => $avance
        ]);

        return redirect('migrations.index')->with($status, $mesage);
    }
    private function migraTCompradores($table_selected){
        $oTable = $this->allTables[$table_selected]['origen'];
        $dTable = $this->allTables[$table_selected]['destino'];
        
        $lastRecord = DB::table($dTable)->orderBy('id', 'desc')->first();

        if(!$lastRecord){
            $oRegistros = DB::connection('sucursal')->table($oTable)->orderBy('id','asc')->limit(10000)->get();
        }else{
            $oRegistros = DB::connection('sucursal')->table($oTable)->where('id', '>', $lastRecord->id)->orderBy('id','asc')->limit(10000)->get();
        }
        $regsel = [];
        $status = 'success';
        $mesage = 'Registros migrados correctamente';
        
        DB::beginTransaction();
        try{
            $counter = 0;
            foreach ($oRegistros as $registro) {
                $regsel = [
                    'id'        => $registro->id,
                    'nombre'    => $registro->nombre,
                    'ine'       => $registro->ife,
                    'rfc'       => $registro->rfc,
                    'celular'   => '',
                    'tarjeta'   => $registro->tarjeta,
                ];
                DB::table($dTable)->insert($regsel);
                $counter++;

                if ($counter % 1000 == 0) {
                    DB::commit();
                    DB::beginTransaction();
                }
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $status = 'error'; 
            $mesage = $e->getMessage();
            dd($regsel,$mesage);
        }

        $num_registros_origen = $this->allTables[$table_selected]['reg_o'];
        $num_registros_destino = DB::table($this->allTables[$table_selected]['destino'])->count();
        $avance = $num_registros_destino / $num_registros_origen * 100;
        Tables::where('id', $table_selected)->update([
            'num_registros_destino' => $num_registros_destino,
            'avance' => $avance
        ]);

        return redirect('migrations.index')->with($status, $mesage);
    }
    private function migraTRetasas($table_selected){
        $oTable = $this->allTables[$table_selected]['origen'];
        $dTable = $this->allTables[$table_selected]['destino'];
        
        $lastRecord = DB::table($dTable)->orderBy('id', 'desc')->first();

        if(!$lastRecord){
            $oRegistros = DB::connection('sucursal')->table($oTable)->orderBy('id','asc')->limit(10000)->get();
        }else{
            $oRegistros = DB::connection('sucursal')->table($oTable)->where('id', '>', $lastRecord->id)->orderBy('id','asc')->limit(10000)->get();
        }
        $regsel = [];
        $status = 'success';
        $mesage = 'Registros migrados correctamente';
        
        DB::beginTransaction();
        try{
            $counter = 0;
            foreach ($oRegistros as $registro) {
                $regsel = [
                    'id'                => $registro->id,
                    't_boleta_id'       => $registro->t_boleta_id,
                    'retasa'            => $registro->retasa,
                    'fecha_registro'    => $registro->fecha_registro,
                ];
                DB::table($dTable)->insert($regsel);
                $counter++;

                if ($counter % 1000 == 0) {
                    DB::commit();
                    DB::beginTransaction();
                }
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $status = 'error'; 
            $mesage = $e->getMessage();
            dd($regsel,$mesage);
        }

        $num_registros_origen = $this->allTables[$table_selected]['reg_o'];
        $num_registros_destino = DB::table($this->allTables[$table_selected]['destino'])->count();
        $avance = $num_registros_destino / $num_registros_origen * 100;
        Tables::where('id', $table_selected)->update([
            'num_registros_destino' => $num_registros_destino,
            'avance' => $avance
        ]);

        return redirect('migrations.index')->with($status, $mesage);
    }
    private function migraTReposiciones($table_selected){
        $oTable = $this->allTables[$table_selected]['origen'];
        $dTable = $this->allTables[$table_selected]['destino'];
        
        $lastRecord = DB::table($dTable)->orderBy('id', 'desc')->first();

        if(!$lastRecord){
            $oRegistros = DB::connection('sucursal')->table($oTable)->orderBy('idRep','asc')->limit(5000)->get();
        }else{
            $oRegistros = DB::connection('sucursal')->table($oTable)->where('idRep', '>', $lastRecord->id)->orderBy('idRep','asc')->limit(5000)->get();
        }
        $regsel = [];
        $status = 'success';
        $mesage = 'Registros migrados correctamente';
        
        DB::beginTransaction();
        try{
            $counter = 0;
            foreach ($oRegistros as $registro) {
                $regsel = [
                    'id'                    => $registro->idRep,
                    't_boleta_id'           => $registro->idB,
                    'prestamo'              => $registro->prestamo,
                    'cargo'                 => $registro->cargo,
                    'tipo_empenio'          => $registro->tipo,
                    // 'pignorante_id'         => $registro->pignotario,
                    'cat_status_empenio_id' => $registro->c_status_empenio_id,
                    'user_id'               => $registro->id_usuario,
                    'created_at'            => $registro->fecha,
                ];
                DB::table($dTable)->insert($regsel);
                $counter++;

                if ($counter % 100 == 0) {
                    DB::commit();
                    DB::beginTransaction();
                }
            }

            DB::statement('
                UPDATE      t_reposicions
                INNER JOIN  t_boletas ON t_boletas.id = t_reposicions.t_boleta_id
                INNER JOIN  pignorantes ON pignorantes.id = t_boletas.pignorante_id
                SET         t_reposicions.pignorante_id = pignorantes.id
                WHERE       t_reposicions.pignorante_id IS NULL
            ');
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $status = 'error'; 
            $mesage = $e->getMessage();
            dd($regsel,$mesage);
        }
 

        /*
            UPDATE
            t_reposicion
            SET
            pignorante_id = u_pignotarios.id
            FROM t_reposicion INNER JOIN t_boleta ON t_boleta.id = t_reposicion.idB
            INNER JOIN u_pignotarios ON u_pignotarios.id = t_boleta.u_pignorante_id
            WHERE t_reposicion.pignorante_id = NULL
        */

        $num_registros_origen = $this->allTables[$table_selected]['reg_o'];
        $num_registros_destino = DB::table($this->allTables[$table_selected]['destino'])->count();
        $avance = $num_registros_destino / $num_registros_origen * 100;
        Tables::where('id', $table_selected)->update([
            'num_registros_destino' => $num_registros_destino,
            'avance' => $avance
        ]);

        return redirect('migrations.index')->with($status, $mesage);
    }
    private function migraTConcentrados($table_selected){
        $oTable = $this->allTables[$table_selected]['origen'];
        $dTable = $this->allTables[$table_selected]['destino'];
        
        $lastRecord = DB::table($dTable)->orderBy('id', 'desc')->first();

        if(!$lastRecord){
            $oRegistros = DB::connection('sucursal')->table($oTable)->orderBy('id','asc')->limit(50000)->get();
        }else{
            $oRegistros = DB::connection('sucursal')->table($oTable)->where('id', '>', $lastRecord->id)->orderBy('id','asc')->limit(50000)->get();
        }
        $regsel = [];
        $status = 'success';
        $mesage = 'Registros migrados correctamente';
        
        DB::beginTransaction();
        try{
            $counter = 0;
            foreach ($oRegistros as $registro) {
                $regsel = [
                    'id'                    => $registro->id,
                    'fecha'                 => $registro->fecha,
                    'hora'                  => $registro->hora,
                    'cantidad_concentrada'  => $registro->cantidad_concentrada,
                    'cantidad_restante'     => $registro->cantidad_restante,
                    'operador_id'           => $registro->id_operador,
                    'gerente_id'            => $registro->id_gerente,

                ];
                DB::table($dTable)->insert($regsel);
                $counter++;

                if ($counter % 1000 == 0) {
                    DB::commit();
                    DB::beginTransaction();
                }
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $status = 'error'; 
            $mesage = $e->getMessage();
            dd($regsel,$mesage);
        }

        $num_registros_origen = $this->allTables[$table_selected]['reg_o'];
        $num_registros_destino = DB::table($this->allTables[$table_selected]['destino'])->count();
        $avance = $num_registros_destino / $num_registros_origen * 100;
        Tables::where('id', $table_selected)->update([
            'num_registros_destino' => $num_registros_destino,
            'avance' => $avance
        ]);

        return redirect('migrations.index')->with($status, $mesage);
    }
    private function migraTVitrinaVentas($table_selected){
        $oTable = $this->allTables[$table_selected]['origen'];
        $dTable = $this->allTables[$table_selected]['destino'];
        
        $lastRecord = DB::table($dTable)->orderBy('id', 'desc')->first();

        if(!$lastRecord){
            $oRegistros = DB::connection('sucursal')->table($oTable)->orderBy('id','asc')->limit(10000)->get();
        }else{
            $oRegistros = DB::connection('sucursal')->table($oTable)->where('id', '>', $lastRecord->id)->orderBy('id','asc')->limit(10000)->get();
        }
        $regsel = [];
        $status = 'success';
        $mesage = 'Registros migrados correctamente';
        
        DB::beginTransaction();
        try{
            $counter = 0;
            foreach ($oRegistros as $registro) {
                $regsel = [
                    'id'            => $registro->id,
                    'fecha_venta'   => $registro->fecha_venta,
                    'capital'       => $registro->capital,
                    'intNormal'     => $registro->intNormal,
                    'intVencido'    => $registro->intVencido,
                    'intAvaluo'     => $registro->intAvaluo,
                    'abonos'        => $registro->abonos,
                    'totalVenta'    => $registro->totalVenta,
                    'comisionVenta' => $registro->comisionVenta,
                    'demasia'       => $registro->demasia,
                    'numReg'        => $registro->numReg,
                ];
                DB::table($dTable)->insert($regsel);
                $counter++;

                if ($counter % 1000 == 0) {
                    DB::commit();
                    DB::beginTransaction();
                }
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $status = 'error'; 
            $mesage = $e->getMessage();
            dd($regsel,$mesage);
        }

        $num_registros_origen = $this->allTables[$table_selected]['reg_o'];
        $num_registros_destino = DB::table($this->allTables[$table_selected]['destino'])->count();
        $avance = $num_registros_destino / $num_registros_origen * 100;
        Tables::where('id', $table_selected)->update([
            'num_registros_destino' => $num_registros_destino,
            'avance' => $avance
        ]);

        return redirect('migrations.index')->with($status, $mesage);
    }
    private function migraTVitrinaCompras($table_selected){
        $oTable = $this->allTables[$table_selected]['origen'];
        $dTable = $this->allTables[$table_selected]['destino'];
        
        $lastRecord = DB::table($dTable)->orderBy('id', 'desc')->first();

        if(!$lastRecord){
            $oRegistros = DB::connection('sucursal')->table($oTable)->orderBy('id','asc')->limit(50000)->get();
        }else{
            $oRegistros = DB::connection('sucursal')->table($oTable)->where('id', '>', $lastRecord->id)->orderBy('id','asc')->limit(50000)->get();
        }
        $regsel = [];
        $status = 'success';
        $mesage = 'Registros migrados correctamente';
        
        DB::beginTransaction();
        try{
            $counter = 0;
            foreach ($oRegistros as $registro) {

                if($registro->fecha_pag == '0000-00-00')
                    $registro->fecha_pag = null;

                $regsel = [
                    'id'                    => $registro->id,
                    't_boleta_id'           => $registro->t_boleta_id,
                    't_subasta_id'          => $registro->t_subasta_id,
                    't_comprador_id'        => $registro->t_comprador_id,
                    'cantidad'              => $registro->cantidad,
                    'fecha'                 => $registro->fecha,
                    'procedencia_venta'     => $registro->procedencia_venta,
                    'precioVenta'           => $registro->precioVenta,
                    'capital'               => $registro->capital,
                    'intNormal'             => $registro->intNormal,
                    'intVencido'            => $registro->intVencido,
                    'intAvaluo'             => $registro->intAvaluo,
                    'abonos'                => $registro->abonos,
                    'totalVenta'            => $registro->totalVenta,
                    'comisionVenta'         => $registro->comisionVenta,
                    'comisionAlmacenaje'    => $registro->comision_almacenaje,
                    'demasia'               => $registro->demasia,
                    'cat_status_demasia_id' => $registro->c_status_demasia_id,
                    'numcheque'             => $registro->num_cheque,
                    'retasa'                => $registro->retasa,
                    'fecha_pago'            => $registro->fecha_pag,
                    'num_tarjeta'           => $registro->num_tarjeta,
                    'lee_reg'               => $registro->lee_reg,
                ];
                DB::table($dTable)->insert($regsel);
                $counter++;

                if ($counter % 1000 == 0) {
                    DB::commit();
                    DB::beginTransaction();
                }
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $status = 'error'; 
            $mesage = $e->getMessage();
            dd($regsel,$mesage);
        }

        $num_registros_origen = $this->allTables[$table_selected]['reg_o'];
        $num_registros_destino = DB::table($this->allTables[$table_selected]['destino'])->count();
        $avance = $num_registros_destino / $num_registros_origen * 100;
        Tables::where('id', $table_selected)->update([
            'num_registros_destino' => $num_registros_destino,
            'avance' => $avance
        ]);

        return redirect('migrations.index')->with($status, $mesage);
    }
    private function migraTDemasiasPagadas($table_selected){
        $oTable = $this->allTables[$table_selected]['origen'];
        $dTable = $this->allTables[$table_selected]['destino'];
        
        $lastRecord = DB::table($dTable)->orderBy('id', 'desc')->first();

        if(!$lastRecord){
            $oRegistros = DB::connection('sucursal')->table($oTable)->orderBy('id','asc')->limit(5000)->get();
        }else{
            $oRegistros = DB::connection('sucursal')->table($oTable)->where('id', '>', $lastRecord->id)->orderBy('id','asc')->limit(5000)->get();
        }
        $regsel = [];
        $status = 'success';
        $mesage = 'Registros migrados correctamente';
        
        DB::beginTransaction();
        try{
            $counter = 0;
            foreach ($oRegistros as $registro) {

                $regsel = [
                    'id'                => $registro->id,
                    'fecha'             => $registro->fecha,
                    'capital_insoluto'  => $registro->capital_insoluto,
                    'int_comision'      => $registro->int_comision,
                    'precio_venta'      => $registro->precio_venta,
                    'demasia'           => $registro->demasia,
                    'demasia_efectivo'  => $registro->demasia_efectivo,
                    'demasia_cheque'    => $registro->demasia_cheque,
                    'num_reg'           => $registro->num_reg,
                ];
                DB::table($dTable)->insert($regsel);
                $counter++;
                
                if ($counter % 100 == 0) {
                    DB::commit();
                    DB::beginTransaction();
                }
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $status = 'error'; 
            $mesage = $e->getMessage();
            dd($regsel,$mesage);
        }

        $num_registros_origen = $this->allTables[$table_selected]['reg_o'];
        $num_registros_destino = DB::table($this->allTables[$table_selected]['destino'])->count();
        $avance = $num_registros_destino / $num_registros_origen * 100;
        Tables::where('id', $table_selected)->update([
            'num_registros_destino' => $num_registros_destino,
            'avance' => $avance
        ]);

        return redirect('migrations.index')->with($status, $mesage);
    }
    private function migraTSuspencionDias($table_selected){
        $oTable = $this->allTables[$table_selected]['origen'];
        $dTable = $this->allTables[$table_selected]['destino'];
        
        $lastRecord = DB::table($dTable)->orderBy('id', 'desc')->first();

        if(!$lastRecord){
            $oRegistros = DB::connection('sucursal')->table($oTable)->orderBy('id','asc')->limit(1000)->get();
        }else{
            $oRegistros = DB::connection('sucursal')->table($oTable)->where('id', '>', $lastRecord->id)->orderBy('id','asc')->limit(1000)->get();
        }
        $regsel = [];
        $status = 'success';
        $mesage = 'Registros migrados correctamente';
        
        DB::beginTransaction();
        try{
            $counter = 0;
            foreach ($oRegistros as $registro) {

                $regsel = [
                    'id'                => $registro->id,
                    'fecha_transaccion' => $registro->fecha_transaccion,
                    'fecha_cobro'       => $registro->fecha_cobro,
                    'fecha_registro'    => $registro->fecha_registro,
                    'user_id'           => $registro->u_operadores_id,
                    'adm_sede_id'       => $registro->c_sucursal_id, //// se debe de poner la sucursal pues es una tabla central

                ];
                DB::table($dTable)->insert($regsel);
                $counter++;
                
                if ($counter % 50 == 0) {
                    DB::commit();
                    DB::beginTransaction();
                }
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $status = 'error'; 
            $mesage = $e->getMessage();
            dd($regsel,$mesage);
        }

        $num_registros_origen = $this->allTables[$table_selected]['reg_o'];
        $num_registros_destino = DB::table($this->allTables[$table_selected]['destino'])->count();
        $avance = $num_registros_destino / $num_registros_origen * 100;
        Tables::where('id', $table_selected)->update([
            'num_registros_destino' => $num_registros_destino,
            'avance' => $avance
        ]);

        return redirect('migrations.index')->with($status, $mesage);
    }
    private function migraRpt01Diario($table_selected){

    }
    private function migraRpt02Diario($table_selected){

    }
    private function migraRpt03Diario($table_selected){

    }
    private function migraTBoletaCancels($table_selected){

    }
    private function migraTCtrlIntCancels($table_selected){

    }
    private function migraTDescuentos($table_selected){

    }
    private function migraTTickets($table_selected){

    }


}
