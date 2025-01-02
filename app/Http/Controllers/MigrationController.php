<?php

namespace App\Http\Controllers;

use App\Models\PignoranteSolidario;
use App\Models\TBoleta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

use function Illuminate\Log\log;

class MigrationController extends Controller
{
    public $allTables = [];

    public function __construct()
    {
        $this->allTables = [
            ['id'=> 0 ,'origen' =>'u_operadores', 'reg_o'=> DB::connection('sucursal')->table('u_operadores')->count()
                      ,'destino'=>'users','reg_d'=> DB::table('users')->count()
                      ,'avance'=>'0'],
            ['id'=> 1 ,'origen' =>'u_pignotarios', 'reg_o'=> DB::connection('sucursal')->table('u_pignotarios')->count()
                      ,'destino'=>'pignorantes','reg_d'=> DB::table('pignorantes')->count()
                      ,'avance'=>'0'],
            ['id'=> 2 ,'origen'  =>'t_boleta', 'reg_o'=> DB::connection('sucursal')->table('t_boleta')->count()
                      ,'destino' =>'t_boletas','reg_d'=> DB::table('t_boletas')->count()
                      ,'avance'=>'0'],
            ['id'=> 3 ,'origen' =>'t_boleta_pagos', 'reg_o'=> DB::connection('sucursal')->table('t_boleta_pagos')->count()
                      ,'destino'=>'t_boleta_pagos','reg_d'=> DB::table('t_boleta_pagos')->count()
                      ,'avance'=>'0'],
            ['id'=> 4 ,'origen' =>'t_empenios', 'reg_o'=> DB::connection('sucursal')->table('t_empenios')->count()
                      ,'destino'=>'t_empenios','reg_d'=> DB::table('t_empenios')->count()
                      ,'avance'=>'0'],
            ['id'=> 5 ,'origen' =>'t_empenios_boleta_relacion', 'reg_o'=> DB::connection('sucursal')->table('t_empenios_boleta_relacion')->count()
                      ,'destino'=>'t_emp_bol_relations','reg_d'=> DB::table('t_emp_bol_relations')->count()
                      ,'avance'=>'0'],
            ['id'=> 6 ,'origen' =>'t_empenios_metal', 'reg_o'=> DB::connection('sucursal')->table('t_empenios_metal')->count()
                      ,'destino'=>'t_empenio_metals','reg_d'=> DB::table('t_empenio_metals')->count()
                      ,'avance'=>'0'],
            ['id'=> 7 ,'origen' =>'t_empenios_productos', 'reg_o'=> DB::connection('sucursal')->table('t_empenios_productos')->count()
                      ,'destino'=>'t_empenio_products','reg_d'=> DB::table('t_empenio_products')->count()
                      ,'avance'=>'0'],
            ['id'=> 8 ,'origen' =>'t_control_interno', 'reg_o'=> DB::connection('sucursal')->table('t_control_interno')->count()
                      ,'destino'=>'t_ctrl_internos','reg_d'=> DB::table('t_ctrl_internos')->count()
                      ,'avance'=>'0'],
            ['id'=> 9 ,'origen' =>'t_caja_monto_operador', 'reg_o'=> DB::connection('sucursal')->table('t_caja_monto_operador')->count()
                      ,'destino'=>'t_cajas','reg_d'=> DB::table('t_cajas')->count()
                      ,'avance'=>'0'],
            ['id'=> 10,'origen' =>'h_t_boleta', 'reg_o'=> DB::connection('sucursal')->table('h_t_boleta')->count()
                      ,'destino'=>'h_boletas','reg_d'=> DB::table('h_boletas')->count()
                      ,'avance'=>'0'],
            ['id'=> 11,'origen' =>'u_pignotarios_solidarios', 'reg_o'=>DB::connection('sucursal')->table('u_pignotarios_solidarios')->distinct()->select('pignorante_solidario')->count()
                      ,'destino'=>'pignorante_solidarios','reg_d'=>DB::table('t_boletas')->whereNotNull('pignorante_solidario_id')->count()   
                      //,'destino'=>'pignorante_solidarios','reg_d'=>DB::table('pignorante_solidarios')->count()   //->whereNotNull('created_at')
                      ,'avance'=>'0'],


                      
            ['id'=> 12,'origen' =>'t_solicitudes_dias_gracia', 'reg_o'=> DB::connection('sucursal')->table('t_solicitudes_dias_gracia')->count()
            ,'destino'=>'t_sol_dias_gracias','reg_d'=> DB::table('t_sol_dias_gracias')->count()
            ,'avance'=>'0'],

            ['id'=> 13,'origen' =>'t_solicitudes_almoneda', 'reg_o'=> DB::connection('sucursal')->table('t_solicitudes_almoneda')->count()
            ,'destino'=>'t_sol_almonedas','reg_d'=> DB::table('t_sol_almonedas')->count()
            ,'avance'=>'0'],
            

            ['id'=> 14,'origen' =>'t_solicitudes_subasta', 'reg_o'=> DB::connection('sucursal')->table('t_solicitudes_subasta')->count()
            ,'destino'=>'t_sol_subastas','reg_d'=> DB::table('t_sol_subastas')->count()
            ,'avance'=>'0'],

            ['id'=> 15,'origen' =>'t_subasta', 'reg_o'=> DB::connection('sucursal')->table('t_subasta')->count()
            ,'destino'=>'t_subastas','reg_d'=> DB::table('t_subastas')->count()
            ,'avance'=>'0'],
            
             //[t_boleta_id, c_fecha_subasta_id, c_status_subasta_id]

        ];


        /* Faltan las tablas
            rg_rod13
            r_rg_cg11
            r_ro_cg12 [u_operador_id]
            t_bloqueadas
            t_boleta_cancelado [t_boleta_id, u_operador_id, c_status_empenio_id, c_tipo_operacion_id, u_pignorante_id, c_tipo_producto_id]
            t_comprador
            t_compra_vitrina [t_boleta_id, t_comprador_id, t_subasta_id, c_status_demasia_id]
            t_concentrados [u_operador_id, u_gerente_id]
            t_control_interno_cancelado [t_boleta_id]
            t_demasias_pagadas
            t_descuentos [t_boleta_id, u_operador_id, c_status, c_status_operacion_id]
            t_num_tickets [t_boleta_id, c_status_boleta_id]
            t_reposicion[boleta_id, c_status_empenio_id]
            t_retasas [t_boleta_id]
            t_suspencion_dias [u_operador_id]
            t_venta_vitrina
            
            t_boletas_pagos_mal_no_venta    >>> ultimo uso en 2018
            t_boleta_migracion              >>> ultimo uso en 2014
            u_directores                    >>> ahora se utiliza la tabla users
        */

        foreach ($this->allTables as $key => $table) {
            $this->allTables[$key]['avance'] = $table['reg_d'] > 0 ? number_format(($table['reg_d']/$table['reg_o'])*100, 1) : '0';
        }
    }
    public function index()
    {
        $databaseName = DB::connection()->getDatabaseName();

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
            UPDATE u_pignotarios SET nombre = TRIM(nombre);
            UPDATE u_pignotarios SET nombre = REPLACE(nombre, ' ', ' ');
            UPDATE u_pignotarios SET nombre = REPLACE(nombre, 'ÃƒÂƒÃ‚ÂƒÃƒÂ‚Ã‚Â‘', 'Ñ'); 
            UPDATE u_pignotarios SET nombre = REPLACE(nombre, 'ÃƒÂƒÃ‚Â‘', 'Ñ'); 
            UPDATE u_pignotarios SET nombre = REPLACE(nombre, 'ÃƒÂ‘', 'Ñ'); 

            UPDATE u_pignotarios SET direccion = REPLACE(direccion, 'ÃƒÂƒÃ‚Â‘', 'Ñ'); 
            UPDATE u_pignotarios SET direccion = REPLACE(direccion, 'ÃƒÂ‘', 'Ñ'); 

            UPDATE h_t_boleta SET comision_avaluo = '109.581' WHERE h_t_boleta.id_interno = 1772075; 
            
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
        */
        
        /* t_reposicion
            ~~En tabla t_reposicion el pignorante no esta referenciado, SE ALMACENA EL nombre completo
            ~~ Habria que referenciarlo mediante el idBoleta
            SELECT * FROM t_reposicion WHERE pignotario LIKE '%ƒ%'; 
            UPDATE t_reposicion SET pignotario = REPLACE(pignotario, 'ÃƒÂ‘', 'Ñ'); 
        */

        /* t_boleta
            
            >>> boleta con datos en null
                DELETE FROM t_boleta WHERE t_boleta.id = 10474068               
            >>> boleta con comision_avaluo numero muy largo
                UPDATE t_boleta SET comision_avaluo = '1095.81' WHERE t_boleta.id = 10604876;       
                UPDATE h_t_boleta SET comision_avaluo = '1095.81' WHERE h_t_boleta.id_interno = 1771886; 

            >>> Borramos 6356 registros de t_boleta_pagos que no existe relacion de 654 boletas en la tabla t_boleta 
                SELECT DISTINCT t_boleta_pagos.t_boleta_id 
                FROM t_boleta_pagos 
                LEFT JOIN t_boleta ON t_boleta_pagos.t_boleta_id = t_boleta.id 
                WHERE t_boleta.id IS null; 
            ❌ DELETE t_boleta_pagos 
                FROM t_boleta_pagos 
                LEFT JOIN t_boleta ON t_boleta_pagos.t_boleta_id = t_boleta.id 
                WHERE t_boleta.id IS null; 
            
        */

        /* t_empenios_boleta_relacion, t_empenios, t_empenios_metal, t_empenios_productos
            >>> t_empenios_boleta_relacion :: verificamos las t_boleta_id que no existen en la tabla t_boletas ~824 boletas
            SELECT DISTINCT t_empenios_boleta_relacion.t_boleta_id, t_empenios.id 
            FROM t_empenios_boleta_relacion 
            LEFT JOIN t_boleta ON t_empenios_boleta_relacion.t_boleta_id = t_boleta.id 
            LEFT JOIN t_empenios ON t_empenios_boleta_relacion.t_empenios_id = t_empenios.id 
            WHERE t_boleta.id IS NULL;
            ❌ DELETE t_empenios_boleta_relacion 
                FROM t_empenios_boleta_relacion 
                LEFT JOIN t_boleta ON t_empenios_boleta_relacion.t_boleta_id = t_boleta.id 
                LEFT JOIN t_empenios ON t_empenios_boleta_relacion.t_empenios_id = t_empenios.id 
                WHERE t_boleta.id IS NULL; 
            
            >>> t_empenios :: borramos los empeños que no tienen relacion t_empenios_boleta_relacion ~824 empeños
            SELECT t_empenios.*
            FROM    t_empenios
            LEFT JOIN t_empenios_boleta_relacion ON t_empenios_boleta_relacion.t_empenios_id = t_empenios.id
            WHERE t_empenios_boleta_relacion.id IS NULL;
            ❌ DELETE t_empenios 
               FROM t_empenios 
               LEFT JOIN t_empenios_boleta_relacion ON t_empenios_boleta_relacion.t_empenios_id = t_empenios.id
               WHERE t_empenios_boleta_relacion.id IS NULL;

            >>> t_empenios_metal :: borramos los empeños que no tienen relacion t_empenios_boleta_relacion ~673 empeños de metal
            SELECT t_empenios_metal.* FROM t_empenios_metal 
              LEFT JOIN t_empenios ON t_empenios.id = t_empenios_metal.t_empenios_id WHERE t_empenios.id IS NULL;
            SELECT t_empenios_metal.* FROM    t_empenios_metal
              LEFT JOIN t_empenios_boleta_relacion ON t_empenios_boleta_relacion.t_empenios_id = t_empenios_metal.t_empenios_id
            WHERE t_empenios_boleta_relacion.id IS NULL;
             ❌ DELETE t_empenios_metal
                FROM    t_empenios_metal
                LEFT JOIN t_empenios_boleta_relacion ON t_empenios_boleta_relacion.t_empenios_id = t_empenios_metal.t_empenios_id
                WHERE t_empenios_boleta_relacion.id IS NULL;
            >>> t_empenios_productos :: borramos los empeños que no tienen relacion t_empenios_boleta_relacion ~114 empeños de productos
             ❌ DELETE t_empenios_productos.*
                FROM    t_empenios_productos
                LEFT JOIN t_empenios_boleta_relacion ON t_empenios_boleta_relacion.t_empenios_id = t_empenios_productos.t_empenios_id
                WHERE t_empenios_boleta_relacion.id IS NULL;

            >>> t_empenios :: se corrigue un error donde un registro de t_empenios no tiene un pignorante_id
            🔃  UPDATE t_empenios SET u_pignorante_id = 1933 WHERE u_pignorante_id = 27441 AND id IN (144879, 152894,152893,193264); 
            >>> Se corrigue un error donde el contenido de un productos no se guardo
            🔃  UPDATE t_empenios_productos SET contenido = '1' WHERE t_empenios_productos.id = 236634;

        */

        /* t_control_interno
            >>> t_control_interno :: verificamos los registros que no tienen relacion con t_boleta    
                SELECT *  FROM t_control_interno 
                LEFT JOIN t_boleta ON t_control_interno.t_boleta_id = t_boleta.id 
                WHERE t_boleta.id IS null; 
            ❌ DELETE t_control_interno  FROM t_control_interno 
                LEFT JOIN t_boleta ON t_control_interno.t_boleta_id = t_boleta.id 
                WHERE t_boleta.id IS null;
        */

        /* t_caja_monto_operador
            >>> t_caja_monto_operador :: las ventas en subasta, no guardan el id del operador en la tabla t_caja_monto_operador
                SELECT * FROM t_caja_monto_operador WHERE u_operadores_id = 0; 
             🔃 UPDATE t_caja_monto_operador SET u_operadores_id = 126 WHERE u_operadores_id = 0; 
            >>> t_caja_monto_operador :: Se corrigue un error donde el monto de la caja rebasa el valor permitido de 8 enteros y 2 decimales
                SELECT * FROM t_caja_monto_operador WHERE caja > 100000000.00; 
             🔃 UPDATE t_caja_monto_operador SET caja = 1000000.00 WHERE caja > 99999999;
        */

        /* u_pignotarios_solidarios
            >>> eliminamos espacion en blanco al inicio y al final de los nombres
            🔃  UPDATE u_pignotarios_solidarios SET pignorante_solidario = TRIM(pignorante_solidario); 
            🔃  UPDATE u_pignotarios_solidarios SET pignorante_solidario = UPPER(pignorante_solidario); 
            🔃  UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, '  ', ' '); 

            >>> Revisamos los registros de pignorante_solidarios sean nombres invalidos, para ser eliminados
            SELECT pignorante_solidario, COUNT(t_boleta_id) FROM u_pignotarios_solidarios WHERE LENGTH(pignorante_solidario) < 9 GROUP BY pignorante_solidario; 
            ❌  DELETE FROM u_pignotarios_solidarios WHERE LENGTH(pignorante_solidario) < 9 
            SELECT DISTINCT pignorante_solidario FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '% DEJA%'; 
            ❌  DELETE FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '% DEJA%' AND LENGTH(pignorante_solidario) < 12
            SELECT DISTINCT pignorante_solidario FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '%EL M%' AND LENGTH(pignorante_solidario) < 12 
            ❌  DELETE FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '%EL M%' AND LENGTH(pignorante_solidario) < 12;  
            SELECT DISTINCT pignorante_solidario FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '%ELLA%' AND LENGTH(pignorante_solidario) < 15;
            ❌  DELETE FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '%ELLA%' AND LENGTH(pignorante_solidario) < 15;   
            SELECT DISTINCT pignorante_solidario FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '% SOLA %'; 
            ❌  DELETE FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '%SOLA%' AND LENGTH(pignorante_solidario) < 12; 
            SELECT DISTINCT pignorante_solidario FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '% MIXSMO %'; 
            ❌  DELETE FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '%MIXSMO%'; 
            SELECT DISTINCT pignorante_solidario FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '% MIS%'; 
            ❌  DELETE FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '% MIS%' AND LENGTH(pignorante_solidario) < 15; 
            SELECT DISTINCT pignorante_solidario FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '% MISMO%'; 
            ❌  DELETE FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '% MISMO%'; 
            SELECT * FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '%VIVE SOLA%'
            ❌  DELETE FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '%VIVE SOLA%'; 
            SELECT * FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '%ELLA %'; 

            SELECT * FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '%ƒƒ%';
            🔃  UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'Ã', 'ƒ');
                UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'Â', 'ƒ');
                UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, '±', 'ƒ');
                UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, '†', 'ƒ');
                UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'Æ', 'ƒ');
                UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'ƒ‚', 'ƒ');
                UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'ƒ‘', 'ƒ');
                UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'ƒ’', 'ƒ');
                UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'ƒƒ', 'ƒ'); 
            SELECT * FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '%ƒƒ%';
            🔃  UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'ƒ', 'Ñ'); 
            
        */

        /* t_subasta
        
            DELETE FROM t_subasta WHERE `t_subasta`.`id` = 13739
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
    public function update($migration)
    {
        switch ($migration){
            case 0:     $this->migraUsers(0);           break;
            case 1:     $this->migraPignorantes(1);     break;
            case 2:     $this->migraTBoleta(2);         break;            
            case 3:     $this->migraTBoletaPagos(3);    break;
            case 4:     $this->migraTEmpenios(4);       break;
            case 5:     $this->migraTEmpBolRelation(5); break;
            case 6:     $this->migraTEmpMetal(6);       break;
            case 7:     $this->migraTEmpProducts(7);    break;
            case 8:     $this->migraTCtrlInterno(8);    break;
            case 9:     $this->migraTCajas(9);          break;
            case 10:    $this->migraHBoleta(10);        break;
            case 11:    $this->migraPig_Solidarios(11); break;
            case 12:    $this->migraTSolDiasGracias(12);break;
            case 13:    $this->migraTSolAlmonedas(13);  break;
            case 14:    $this->migraTSolSubastas(14);   break;
            case 15:    $this->migraTSubastas(15);      break;            
            default:    return to_route('migrations.index')->with('error', 'no existe tabla seleccionada');
        }
        return to_route('migrations.index');
    }
    private function migraUsers($table_selected)
    {
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
                    $num_sucursal = $registro->c_sucursal_id*1000;
                    if($registro->rfc == ''){
                        $registro->rfc = $num_sucursal + $registro->id;
                    }

                    $regsel = [
                        'id'                => $registro->id,
                        'global_id'         => $num_sucursal + $registro->id,
                        'name'              => $registro->nombre,
                        'email'             => $registro->rfc.'@'.$registro->usuario,
                        'username'          => $registro->usuario,
                        'genero'            => $registro->genero,
                        // 'isSuper'           => $registro->isSuper,
                        // 'isAdmin'           => $registro->isAdmin,
                        'sede_id'           => $registro->c_sucursal_id,
                        'tenant_id'         => $databaseName,
                        // 'tema'              => $registro->tema,
                        'fecha_baja'        => $registro->fecha_fin_periodo,
                        'password'          => $registro->password,
                        // 'email_verified_at' => $registro->email_verified_at,
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
                dd( $regsel,$mesage, $oRegistros);
            }
        }else{
            $status = 'success';
            $mesage = 'Los usuarios ya han sido migrados';
        }

        return redirect('migrations.index')->with($status, $mesage);
    }
    private function migraPignorantes($table_selected)
    {
        $oTable = $this->allTables[$table_selected]['origen'];
        $dTable = $this->allTables[$table_selected]['destino'];

        $lastRecord = DB::table($dTable)->orderBy('id', 'desc')->first();

        if(!$lastRecord){
            $oRegistros = DB::connection('sucursal')->table($oTable)->limit(10000)->get();
        }else{
            $oRegistros = DB::connection('sucursal')->table($oTable)->where('id', '>', $lastRecord->id)->limit(10000)->get();
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
            dd( $regsel,$mesage, $oRegistros);
        }

        return redirect('migrations.index')->with($status, $mesage);
    }
    private function migraTBoleta($table_selected)
    {
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
            dd( $regsel,$mesage, $oRegistros);
        }

        return redirect('migrations.index')->with($status, $mesage);
        
    }
    private function migraTBoletaPagos($table_selected)
    {
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
            dd($regsel, $mesage, $oRegistros);
        }

        return redirect('migrations.index')->with($status, $mesage);

        
    }
    private function migraTEmpenios($table_selected)
    {
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
                dd( $regsel,$mesage, $oRegistros);
            }
            

        return redirect('migrations.index')->with($status, $mesage);
    }
    private function migraTEmpBolRelation($table_selected)
    {
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
            dd( $regsel,$mesage, $oRegistros);
        }

        return redirect('migrations.index')->with($status, $mesage);
    }
    private function migraTEmpMetal($table_selected)
    {
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
            dd( $regsel,$mesage, $oRegistros);
        }

        return redirect('migrations.index')->with($status, $mesage);
    }
    private function migraTEmpProducts($table_selected)
    {
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
            dd( $regsel,$mesage, $oRegistros);
        }

        return redirect('migrations.index')->with($status, $mesage);
    }
    private function migraTCtrlInterno($table_selected)
    {
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
            dd( $regsel,$mesage, $oRegistros);
        }

        return redirect('migrations.index')->with($status, $mesage);
    }
    private function migraTCajas($table_selected)
    {
        $oTable = $this->allTables[$table_selected]['origen'];
        $dTable = $this->allTables[$table_selected]['destino'];

        $lastRecord = DB::table($dTable)->orderBy('id', 'desc')->first();

        if(!$lastRecord){
            $oRegistros = DB::connection('sucursal')->table($oTable)->orderBy('id','asc')->limit(65000)->get();
        }else{
            $oRegistros = DB::connection('sucursal')->table($oTable)->where('id', '>', $lastRecord->id)->orderBy('id','asc')->limit(65000)->get();
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
            dd( $regsel,$mesage, $oRegistros);
        }

        return redirect('migrations.index')->with($status, $mesage);
    }
    private function migraHBoleta($table_selected)
    {
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
            dd( $regsel,$mesage, $oRegistros);
        }

        return redirect('migrations.index')->with($status, $mesage);
    }
    private function migraPig_Solidarios($table_selected)
    {
        
        $regsel = [];
        $status = 'success';
        $mesage = 'Registros migrados correctamente';

        $oTable = $this->allTables[$table_selected]['origen'];
        $dTable = $this->allTables[$table_selected]['destino'];
        $numRegDestino = $this->allTables[$table_selected]['reg_d'];

        $listaPigSolidarios = DB::connection('sucursal')->table($oTable)->distinct()
            ->select('t_boleta.u_pignorante_id','u_pignotarios_solidarios.pignorante_solidario')
                ->join('t_boleta','t_boleta.id','=','u_pignotarios_solidarios.t_boleta_id')
                ->orderBy('u_pignotarios_solidarios.pignorante_solidario')   
                ->offset(10000)     //--> de 10,000 en 10,000 hasta el total de registros
                ->limit(10000)                             
                ->get();

        //El resultado real de $listaPigSolidarios en de 31,829 registros,
        //pero al realizar el pluck los registros bajan a 30,092, que equivalen a 1,737 registros menos; 
        // debido a que la llave del pluck(pignorante_solidario) solo mantiene 1 nombre parecido
        // lo ideal es usar el metodo get() para obtener todos los registros
        
        if($listaPigSolidarios->count()){
            DB::beginTransaction();
            try{
                foreach($listaPigSolidarios as $pignorante)   {               
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
           
            $lastTBoleta = DB::table('t_boletas')->whereNotNull('pignorante_solidario_id')->orderBy('pignorante_solidario_id', 'desc')->first();

            if(!$lastTBoleta)
                $PSolidarios = DB::table('pignorante_solidarios')->orderBy('id','asc')->limit(1000)->get();
            else
                $PSolidarios = DB::table('pignorante_solidarios')->where('id', '>', $lastTBoleta->pignorante_solidario_id)->orderBy('id','asc')->limit(1000)->get();
            
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

        return redirect('migrations.index')->with($status, $mesage);
    }
    private function migraTSolDiasGracias($table_selected)
    {
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
            dd( $regsel,$mesage, $oRegistros);
        }

        return redirect('migrations.index')->with($status, $mesage);
    }
    private function migraTSolAlmonedas($table_selected)
    {
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
            dd( $regsel,$mesage, $oRegistros);
        }

        return redirect('migrations.index')->with($status, $mesage);
    }
    private function migraTSolSubastas($table_selected)
    {
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
            dd( $regsel,$mesage, $oRegistros);
        }

        return redirect('migrations.index')->with($status, $mesage);
    }
    private function migraTSubastas($table_selected)
    {
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
            dd($regsel,$mesage, $oRegistros);
        }

        return redirect('migrations.index')->with($status, $mesage);
    }
}
