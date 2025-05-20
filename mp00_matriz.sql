-- Active: 1747336191893@@localhost@3309@mp_matriz
--> Opción 1: (DESCARTADA) transferimos el archivo de la base de datos desde windows a docker
$ cp /mnt/c/Users/Dell/Downloads/BD_30_abril/mp_matriz_250430.sql.gz ~/db-migrations/Windows/
$ gunzip -c Windows/mp_matriz_250430.sql.gz | ./vendor/bin/sail exec -T mysql mysql -u root mp_matriz
-->> Borramos el archivo de la base de datos
$ rm mp_matriz_250430.sql.gz

-->> Opción 2:(RECOMENDADA) Importacion de la base de datos directamente de la carpeta de dowloads de windows 
-->> al contenedor de mysql de docker
$ gunzip -c /mnt/c/Users/Dell/Downloads/BD_30_abril/mp_matriz.gz | ./vendor/bin/sail exec -T mysql mysql -u root mp_matriz

/*
⊢—⊣  —⊑=== === ===⊒ ⁅—————⁆ ‗‗‗‗‗‗‗‗‗‗‗‗⊢——————⊣⊺⊾⊶——⊷---⊸  ⇲⇱ 
---⫟⫟⫠⫰⫯⪦⨷⊹⊹⊶⊶-- ⋌⋋⋉ —⫍—⊟—⊞—⊞—⫎—---|⪧⋊---—⫍⊤|⊏=== ===⊐---⫠⫞----⊣ ---|‾‾‾‾‾‾‾‾‾‾‾‾‾|--- ⨽---⨼–⫱=== ===————— 
*/


-- ELIMINAMOS 29 TABLAS INNECESARIAS         
    DROP TABLE 
        c_cotiza_producto_08112015,         c_fecha_reporte,         c_nivel,         c_printer_operador,         c_printer_operador_tipo, 
        c_sub_productos_08112015,         c_sub_productos_2014_12_12,         c_sucursal_12042015,         c_sucursal_v1, 
        c_status_usuario,        c_intereses,        c_tipo_prestamo_12042015,         c_tipo_printer,         h_rp_subasta, 
        rg_dda07,         rg_ddd04,         rg_de02,         rg_dra06,         rg_drd03,         temporal,         t_boleta_202006, 
        t_boleta_pagos_19022015,         t_boleta_pagos_old_19022015,        t_boetas_pagos_mal_NoVenta,         t_boleta_migracion,
        t_empenios_2014_12_12,         t_empenios_metal_2014_12_12,         t_empenios_productos_2014_12_12,         t_migration_missing, 
        t_subasta_copy,        u_directores;
    DROP VIEW boleta;

$ sail artisan migrate:fresh --seed

DROP TRIGGER IF EXISTS `t_boleta_cancelar`;
DROP TRIGGER IF EXISTS `t_boleta_historico`;
DROP TRIGGER IF EXISTS `t_boleta_numeroInterno`;
DROP TRIGGER IF EXISTS `agregar_cancelado`;
DROP TRIGGER IF EXISTS `suma_totales`;

/*  catalogos   --------------------------------------------------------------------------------|*/
UPDATE `c_sucursal` SET `monto_max_concentrado` = id WHERE 1;   -- Rspaldo del id original
UPDATE c_sucursal SET id = 100 WHERE id = 15;
UPDATE c_sucursal SET id = 101 WHERE id = 16;
UPDATE c_sucursal SET id = 102 WHERE id = 12;
UPDATE c_sucursal SET id = 103 WHERE id = 28;
UPDATE c_sucursal SET id = 104 WHERE id = 31;
UPDATE c_sucursal SET id = 105 WHERE id = 24;
UPDATE c_sucursal SET id = 106 WHERE id = 13;
UPDATE c_sucursal SET id = 107 WHERE id = 17;
UPDATE c_sucursal SET id = 108 WHERE id = 30;
UPDATE c_sucursal SET id = 109 WHERE id = 32;
UPDATE c_sucursal SET id = 110 WHERE id = 25;
UPDATE c_sucursal SET id = 111 WHERE id = 18;
UPDATE c_sucursal SET id = 112 WHERE id = 14;
UPDATE c_sucursal SET id = 113 WHERE id = 19;
UPDATE c_sucursal SET id = 114 WHERE id = 20;
UPDATE c_sucursal SET id = 115 WHERE id = 22;
UPDATE c_sucursal SET id = 116 WHERE id = 11;
UPDATE c_sucursal SET id = 117 WHERE id = 21;
UPDATE c_sucursal SET id = 118 WHERE id = 27;
UPDATE c_sucursal SET id = 119 WHERE id = 23;
UPDATE c_sucursal SET id = 120 WHERE id = 29;
UPDATE c_sucursal SET id = 121 WHERE id = 26;
UPDATE c_sucursal SET id = 125 WHERE id = 33;
UPDATE c_sucursal SET id = 126 WHERE id = 34;

--Actualizamos el id de la sucursal en la tabla c_tipo_prestamo_sucursal
UPDATE `c_tipo_prestamo_sucursal` INNER JOIN c_sucursal ON c_tipo_prestamo_sucursal.c_sucursal_id = c_sucursal.monto_max_concentrado SET c_tipo_prestamo_sucursal.c_sucursal_id = c_sucursal.id;
UPDATE `u_operadores` SET `c_sucursal_id` = 100 WHERE c_sucursal_id = 15; 
UPDATE `t_control_interno` SET `c_sucursal_id` = 100 WHERE c_sucursal_id = 15; 

UPDATE `r_ro_cg12` SET `sucursal_id` = 100 WHERE sucursal_id = 15; 
UPDATE `r_ro_cg12` SET `sucursal_id` = 112 WHERE sucursal_id = 14;  -- Modulo azul
UPDATE `r_ro_cg12` SET `sucursal_id` = 108 WHERE sucursal_id = 30;  --20 de noviembre

UPDATE `r_rg_cg11` SET `sucursal_id` = 100 WHERE sucursal_id = 15;   
UPDATE `rg_rod13` SET `sucursal_id` = 100 WHERE sucursal_id = 15;   
UPDATE `c_fecha_subasta` SET `c_sucursal_id` = 100 WHERE c_sucursal_id = 15; 
UPDATE `t_concentrados` SET `sucursal` = 100 WHERE sucursal = 15; 
UPDATE `t_concentrados` SET `sucursal` = 112 WHERE sucursal = 14;   -- Modulo azul
UPDATE `t_concentrados` SET `sucursal` = 121 WHERE sucursal = 26;   -- Tlacolula

UPDATE `t_descuentos` SET `c_sucursal` = 100 WHERE c_sucursal = 15; 
UPDATE `t_compra_vitrina` SET `c_sucursal_id` = 100 WHERE c_sucursal_id = 15; 
UPDATE t_suspencion_dias SET c_sucursal_id = 100 WHERE c_sucursal_id = 15;
UPDATE t_control_interno_cancelado SET c_sucursal_id = 100 WHERE c_sucursal_id = 15;
UPDATE t_control_interno_cancelado SET c_sucursal_id = 100 WHERE c_sucursal_id = 0;

/*  u_operadores   --------------------------------------------------------------------------------|*/
-- Operadores que no estan en t_boleta
    SELECT        u_operadores.id    FROM        u_operadores
    LEFT JOIN t_boleta ON t_boleta.u_operador_id = u_operadores.id
    WHERE t_boleta.u_operador_id IS null
    ORDER BY u_operadores.id

    SELECT DISTINCT u_operadores.id, u_operadores.nombre, u_operadores.usuario FROM u_operadores 
    INNER JOIN t_boleta ON t_boleta.u_operador_id = u_operadores.id 
    ORDER BY u_operadores.id; 

    UPDATE u_operadores SET nombre = UPPER(nombre) WHERE 1;
    UPDATE u_operadores SET nombre = TRIM(nombre) WHERE 1;
    UPDATE u_operadores SET nombre = REPLACE(nombre, '  ', ' ') WHERE 1;           -- x2
    UPDATE    `u_operadores` SET    `rfc` = id WHERE 1;

 -- marcamos a los operadores que  tienen registros en otras tablas
    UPDATE u_operadores AS u SET genero = genero + 100000000 WHERE EXISTS (SELECT 1 FROM t_boleta b WHERE b.u_operador_id = u.id LIMIT 1); 
    UPDATE u_operadores AS u SET genero = genero + 20000000 WHERE EXISTS (SELECT 1 FROM h_t_boleta h  WHERE h.u_operador_id   = u.id LIMIT 1); 
    UPDATE u_operadores AS u SET genero = genero + 3000000 WHERE EXISTS (SELECT 1 FROM t_caja_monto_operador m  WHERE m.u_operadores_id = u.id LIMIT 1);
    UPDATE u_operadores AS u SET genero = genero + 400000 WHERE EXISTS (SELECT 1 FROM r_ro_cg12 p  WHERE p.id_operador     = u.id LIMIT 1);
    UPDATE u_operadores AS u SET genero = genero + 50000 WHERE EXISTS (SELECT 1 FROM t_concentrados t  WHERE t.id_operador     = u.id LIMIT 1);
    UPDATE u_operadores AS u SET genero = genero + 60000 WHERE EXISTS (SELECT 1 FROM t_concentrados t2 WHERE t2.id_gerente     = u.id LIMIT 1);
    UPDATE u_operadores AS u SET genero = genero + 1000 WHERE EXISTS (SELECT 1 FROM t_reposicion          r  WHERE r.id_usuario      = u.id LIMIT 1);
    UPDATE u_operadores AS u SET genero = genero + 200 WHERE EXISTS (SELECT 1 FROM t_boleta_cancelado    c  WHERE c.u_operador_id   = u.id LIMIT 1);
    UPDATE u_operadores AS u SET genero = genero + 30 WHERE EXISTS (SELECT 1 FROM t_suspencion_dias     s  WHERE s.u_operadores_id = u.id LIMIT 1);
    UPDATE u_operadores AS u SET genero = genero + 4 WHERE EXISTS (SELECT 1 FROM t_descuentos          d  WHERE d.id_operador     = u.id LIMIT 1);

    UPDATE `u_operadores` SET id = id - 1300 WHERE id > 1000; 

    UPDATE `u_operadores` SET `id` = '100' WHERE `u_operadores`.`id` = 666;     --> 100 para el administrador
    UPDATE `t_concentrados` SET `id_gerente` = '121' WHERE `id_gerente` = 0; -- para evitar errores de integridad referencial

    UPDATE t_boleta SET u_operador_id = u_operador_id - 1300 WHERE u_operador_id > 1000; 
    UPDATE t_boleta SET u_operador_id = '100' WHERE u_operador_id = 666;     --> 100 para el administrador

    UPDATE t_boleta SET u_operador_id = 151 WHERE u_operador_id = 105
    UPDATE t_boleta SET u_operador_id = 237 WHERE u_operador_id = 256

    UPDATE h_t_boleta SET u_operador_id = u_operador_id - 1300 WHERE u_operador_id > 1000; 
    UPDATE h_t_boleta SET u_operador_id = 151 WHERE u_operador_id = 105;
    UPDATE h_t_boleta SET u_operador_id = 237 WHERE u_operador_id = 256;

    UPDATE t_caja_monto_operador SET u_operadores_id = u_operadores_id - 1300 WHERE u_operadores_id > 1000; 
    UPDATE t_caja_monto_operador SET u_operadores_id = 100 WHERE u_operadores_id = 0;     --> 100 para el administrador
    UPDATE t_caja_monto_operador SET u_operadores_id = 100 WHERE u_operadores_id = 666;     --> 100 para el administrador

    UPDATE t_caja_monto_operador SET u_operadores_id = 151 WHERE u_operadores_id = 105;
    UPDATE t_caja_monto_operador SET u_operadores_id = 237 WHERE u_operadores_id = 256;


    UPDATE t_boleta_cancelado SET u_operador_id = u_operador_id - 1300 WHERE u_operador_id > 1000; 
    UPDATE t_boleta_cancelado SET u_operador_id = '100' WHERE u_operador_id = 666;     --> 100 para el administrador
    UPDATE t_boleta_cancelado SET u_operador_id = '100' WHERE u_operador_id = 0;     --> 100 para el administrador


    UPDATE t_concentrados SET id_operador = id_operador - 1300 WHERE id_operador > 1000 AND sucursal = 100; 
    -- Operadores externos: Modulo Azul(193,186), 
    UPDATE t_concentrados SET id_operador = 118 WHERE id_operador = 186 AND sucursal = 112;
    UPDATE t_concentrados SET id_operador = 159 WHERE id_operador = 193 AND sucursal = 112;
    -- UPDATE t_concentrados SET id_operador = 220 WHERE id_operador = 220 AND sucursal = 121;  -- Tlacolula(220)

    UPDATE t_reposicion SET id_usuario = id_usuario - 1300 WHERE id_usuario > 1000; 
    UPDATE t_descuentos SET id_operador = id_operador - 1300 WHERE id_operador > 1000 AND c_sucursal = 100; 

    UPDATE t_suspencion_dias SET u_operadores_id = 126 WHERE u_operadores_id = 862;

    UPDATE r_ro_cg12 SET id_operador = id_operador - 1300 WHERE id_operador > 1000 AND sucursal_id = 100; 
    -- Operadores repetidos se unifican
    UPDATE r_ro_cg12 SET id_operador = 100 WHERE id_operador = 666;     --> 100 para el administrador
    UPDATE r_ro_cg12 SET id_operador = 100 WHERE id_operador = 0;     --> 100 para el administrador
    UPDATE r_ro_cg12 SET id_operador = 116 WHERE id_operador = 129;
    UPDATE r_ro_cg12 SET id_operador = 118 WHERE id_operador = 130;
    UPDATE r_ro_cg12 SET id_operador = 151 WHERE id_operador = 142;
    UPDATE r_ro_cg12 SET id_operador = 203 WHERE id_operador = 169;
    UPDATE r_ro_cg12 SET id_operador = 196 WHERE id_operador = 171;
    UPDATE r_ro_cg12 SET id_operador = 197 WHERE id_operador = 195;
    UPDATE r_ro_cg12 SET id_operador = 229 WHERE id_operador = 224;
    UPDATE r_ro_cg12 SET id_operador = 160 WHERE id_operador = 168 AND sucursal_id = 112;   --> Modulo Azul
    UPDATE r_ro_cg12 SET id_operador = 206 WHERE id_operador = 920 AND sucursal_id = 108;   --> 20 de noviembre    
    UPDATE r_ro_cg12 SET id_operador = 201 WHERE id_operador = 205 AND sucursal_id = 108;   --> 20 de noviembre    
    UPDATE r_ro_cg12 SET id_operador = 202 WHERE id_operador = 206 AND sucursal_id = 108;   --> 20 de noviembre

SHOW PROCESSLIST;


/*  u_pignotarios   --------------------------------------------------------------------------------|*/

 SELECT nombre FROM `u_pignotarios` WHERE nombre LIKE "%‘%";          
    UPDATE u_pignotarios SET nombre = TRIM(nombre);
    UPDATE u_pignotarios SET nombre = REPLACE(nombre, '  ', ' ');           -- x2
    UPDATE u_pignotarios SET nombre = REPLACE(nombre, 'Ãƒ', 'ª'); 
    UPDATE u_pignotarios SET nombre = REPLACE(nombre, 'Âƒ', 'ª'); 
    UPDATE u_pignotarios SET nombre = REPLACE(nombre, 'Ã‚', 'ª'); 
    UPDATE u_pignotarios SET nombre = REPLACE(nombre, 'Â‚', 'ª'); 
    UPDATE u_pignotarios SET nombre = REPLACE(nombre, 'Ã‘', 'ª');
    UPDATE u_pignotarios SET nombre = REPLACE(nombre, 'Â‘', 'ª');
    UPDATE u_pignotarios SET nombre = REPLACE(nombre, 'N‘', 'ª'); 
    UPDATE u_pignotarios SET nombre = REPLACE(nombre, 'Ñ‘', 'ª');             
    UPDATE u_pignotarios SET nombre = REPLACE(nombre, 'ªª', 'ª');             -- x3
SELECT nombre FROM `u_pignotarios` WHERE nombre LIKE "%ªª%";          
SELECT nombre FROM `u_pignotarios` WHERE nombre LIKE "%ª%";          
    UPDATE u_pignotarios SET nombre = REPLACE(nombre, 'ª', 'Ñ'); 
 -- 
    SELECT direccion FROM `u_pignotarios` WHERE direccion LIKE "%‘%";           
    UPDATE u_pignotarios SET direccion = REPLACE(direccion, 'Âƒ', 'ª');
    UPDATE u_pignotarios SET direccion = REPLACE(direccion, 'Ãƒ', 'ª');
    UPDATE u_pignotarios SET direccion = REPLACE(direccion, 'Ã‚', 'ª'); 
    UPDATE u_pignotarios SET direccion = REPLACE(direccion, 'Â‘', 'ª'); 
    UPDATE u_pignotarios SET direccion = REPLACE(direccion, 'Ã‘', 'ª'); 
    UPDATE u_pignotarios SET direccion = REPLACE(direccion, 'ªª', 'ª');     -- x 3
    SELECT direccion FROM `u_pignotarios` WHERE direccion LIKE "%ªª%";           
    SELECT direccion FROM `u_pignotarios` WHERE direccion LIKE "%ª%";           
    UPDATE u_pignotarios SET direccion = REPLACE(direccion, 'ª', 'Ñ');  

 -- VSCRES51120420M500  ::: REPETIDO (13735 --> 21291)   
    SELECT * FROM u_pignotarios WHERE ife = 'VSCRES51120420M500'; 
    UPDATE u_pignotarios SET telefono = '9512096237' WHERE u_pignotarios.id = 21291 AND u_pignotarios.ife = 'VSCRES51120420M500'; 
    UPDATE u_pignotarios SET ife = 'DELETE_VSCRES51120420M500' WHERE u_pignotarios.id = 13735 AND u_pignotarios.ife = 'VSCRES51120420M500'; 
    UPDATE h_t_boleta SET u_pignorante_id = 21291 WHERE u_pignorante_id = 13735; 
    UPDATE t_boleta SET u_pignorante_id = 21291 WHERE u_pignorante_id = 13735; 
    UPDATE t_empenios SET u_pignorante_id = 21291 WHERE u_pignorante_id = 13735; 
    UPDATE t_boleta_cancelado SET u_pignorante_id = 21291 WHERE u_pignorante_id = 13735; 
    
 -- MZCRMR86120120M300  ::: REPETIDO   (22870 --> 23996)
    SELECT * FROM u_pignotarios WHERE ife = 'MZCRMR86120120M300'; 
    UPDATE u_pignotarios SET ife = 'DELETE_MZCRMR86120120M300' WHERE u_pignotarios.id = 22870 AND u_pignotarios.ife = 'MZCRMR86120120M300';  
    UPDATE h_t_boleta SET u_pignorante_id = 23996 WHERE u_pignorante_id = 22870; 
    UPDATE t_boleta SET u_pignorante_id = 23996 WHERE u_pignorante_id = 22870; 
    UPDATE t_empenios SET u_pignorante_id = 23996 WHERE u_pignorante_id = 22870; 
    UPDATE t_boleta_cancelado SET u_pignorante_id = 23996 WHERE u_pignorante_id = 22870;

 -- GRGRCC85041220M600  ::: REPETIDO (5641 --> 2879)
    SELECT * FROM u_pignotarios WHERE ife = 'GRGRCC85041220M600'; 
    UPDATE u_pignotarios SET ife = 'DELETE_GRGRCC85041220M600' WHERE u_pignotarios.id = 5641 AND u_pignotarios.ife = 'GRGRCC85041220M600'; 
    UPDATE h_t_boleta SET u_pignorante_id = 2879 WHERE u_pignorante_id = 5641; 
    UPDATE t_boleta SET u_pignorante_id = 2879 WHERE u_pignorante_id = 5641; 
    UPDATE t_empenios SET u_pignorante_id = 2879 WHERE u_pignorante_id = 5641; 
    UPDATE t_boleta_cancelado SET u_pignorante_id = 2879 WHERE u_pignorante_id = 5641; 

 -- MRGRCR63081520M400  >>> Cp MUY LARGO
    SELECT cp FROM u_pignotarios WHERE ife = 'MRGRCR63081520M400'; 
    UPDATE `u_pignotarios` SET `cp` = '68150' WHERE `u_pignotarios`.`id` = 28228 AND `u_pignotarios`.`ife` = 'MRGRCR63081520M400'; 
    UPDATE u_pignotarios SET cp = '00000' WHERE cp = '0';        
    UPDATE u_pignotarios SET cp = '00000' WHERE cp = '00';        
    UPDATE u_pignotarios SET cp = '00000' WHERE cp = '000';        
    UPDATE u_pignotarios SET cp = '00000' WHERE cp = '0000';        
    UPDATE u_pignotarios SET cp = '00000' WHERE cp = '000000';        
    UPDATE u_pignotarios SET cp = '00000' WHERE cp = '0000000';        
   

/*-------------------------------------------------  u_pignotarios_solidarios   */
 -- 🔃 actualizamos todo a mayusculas, quitamos espacions dobles y eliminamos espacion en blanco al inicio y al final de los nombres
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = UPPER(pignorante_solidario); 
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, '  ', ' ');    -- x 4
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'NADIE', ''); 
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'NO DEJA', ''); 
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'NO DEJA', ''); 
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'EL MISMO', '') WHERE LENGTH(pignorante_solidario) > 13;  
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = TRIM(pignorante_solidario); 

    UPDATE `u_pignotarios_solidarios` SET `pignorante_solidario` = 'EL MISMO' WHERE `u_pignotarios_solidarios`.`id` = 211770; 
    UPDATE `u_pignotarios_solidarios` SET `pignorante_solidario` = 'IRMA RUIZ ' WHERE `u_pignotarios_solidarios`.`id` = 38829; 
    UPDATE `u_pignotarios_solidarios` SET `pignorante_solidario` = 'ANA ROJAS ' WHERE `u_pignotarios_solidarios`.`id` = 40771; 
    UPDATE `u_pignotarios_solidarios` SET `pignorante_solidario` = 'MARIA PAZ ' WHERE `u_pignotarios_solidarios`.`id` = 246184; 
 -- 👀 Revisamos los registros de pignorante_solidarios NO sean nombres invalidos, para ser eliminados
    SELECT pignorante_solidario, COUNT(t_boleta_id) FROM u_pignotarios_solidarios WHERE LENGTH(pignorante_solidario) < 10 GROUP BY pignorante_solidario; 
        DELETE FROM u_pignotarios_solidarios WHERE LENGTH(pignorante_solidario) < 10;       --APROX ~51966
    SELECT DISTINCT pignorante_solidario FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '% DEJA%'; 
        DELETE FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '% DEJA%' AND LENGTH(pignorante_solidario) < 18;
    SELECT DISTINCT pignorante_solidario FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '% MIS%' AND LENGTH(pignorante_solidario) < 16; 
        DELETE FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '% MIS%' AND LENGTH(pignorante_solidario) < 16;
    SELECT DISTINCT pignorante_solidario FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '%EL M%' AND LENGTH(pignorante_solidario) < 12; 
        DELETE FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '%EL M%' AND LENGTH(pignorante_solidario) < 12;  
    SELECT DISTINCT pignorante_solidario FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '%ELLA%' AND LENGTH(pignorante_solidario) < 15;
        DELETE FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '%ELLA%' AND LENGTH(pignorante_solidario) < 15;       
    SELECT DISTINCT pignorante_solidario FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '% SOLA %' AND LENGTH(pignorante_solidario) < 12; 
        DELETE FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '%SOLA%' AND LENGTH(pignorante_solidario) < 12; 

 --  851 pignorantes solidarios con el nombre con caracteres invalidos
    SELECT * FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '%‘%';        
            
        UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'Âƒ', 'ª');
        UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'Ãƒ', 'ª');
        UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'Ã‚', 'ª');
        UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'Â‚', 'ª');
        UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'Â‘', 'ª');
        UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'Â’', 'ª');
        UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'Ã‘', 'ª');

        UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'Â±', 'ª');
        UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'Â±', 'ª');
        UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'Â†', 'ª');
        UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'Ã†', 'ª');
        UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'Æ’', 'ª');
        UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'ªª', 'ª');    -- x8
    SELECT * FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '%ªª%';           
    SELECT * FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '%ª%';           
        UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'ª', 'Ñ'); 
OPTIMIZE TABLE `u_pignotarios_solidarios` 

/*  t_boleta   --------------------------------------------------------------------------------|*/

 -->> boleta con datos en null
    DELETE FROM t_boleta WHERE t_boleta.id = 10474068;               
 -->> boleta con comision_avaluo numero muy largo (10604876)
    UPDATE t_boleta SET comision_avaluo = '1095.81' WHERE t_boleta.id = 10604876;       
        

/*  h_t_boleta   --------------------------------------------------------------------------------|*/

 -->> boleta con comision_avaluo numero muy largo (1771886, 1786792)
        UPDATE h_t_boleta SET comision_avaluo = '1095.81' WHERE h_t_boleta.id_interno = 1771886; 
        UPDATE h_t_boleta SET comision_avaluo = '1095.81' WHERE h_t_boleta.id_interno = 1786792; 
        UPDATE h_t_boleta SET comision_avaluo = '109.581' WHERE comision_avaluo > 109581000; 


/*  t_boleta_pagos   --------------------------------------------------------------------------------|*/

 -->> Borramos 6392 registros de t_boleta_pagos que no existe relacion de 654 boletas en la tabla t_boleta 
 -->> Sin embargo si existen en la tabla t_boleta_cancelado, pero deben de eliminarse para conservar la integridad de la base de datos
SELECT DISTINCT t_boleta_pagos.t_boleta_id FROM t_boleta_pagos LEFT JOIN t_boleta ON t_boleta_pagos.t_boleta_id = t_boleta.id  WHERE t_boleta.id IS null; 
    DELETE t_boleta_pagos FROM t_boleta_pagos LEFT JOIN t_boleta ON t_boleta_pagos.t_boleta_id = t_boleta.id WHERE t_boleta.id IS null; 
    OPTIMIZE TABLE t_boleta_pagos
            
/*  t_empenios_boleta_relacion, t_empenios   --------------------------------------------------------------------------------|*/

SELECT * FROM t_empenios_boleta_relacion LEFT JOIN t_empenios ON t_empenios_boleta_relacion.t_empenios_id = t_empenios.id WHERE t_empenios.id IS null; 


-->> con esta consulta se encuentra el empeño repetido
    SELECT t_empenios.id, COUNT(t_empenios_boleta_relacion.t_empenios_id ) as connteo FROM t_empenios_boleta_relacion LEFT JOIN t_empenios ON t_empenios_boleta_relacion.t_empenios_id = t_empenios.id GROUP BY t_empenios.id ORDER by COUNT(t_empenios_boleta_relacion.t_empenios_id ) DESC; 
-->> se encontro que el t_empenio_id:236634 se repite en las boletas: (10571943, 10575026), 
 --| Sin embargo el empeño 236634 esta vinculado a la boleta 10575026 de acuerdo a avaluo y tipo de prenda (PULSERA $7,850), 
 --| y el empeño 236635 le corresponde a la boleta 10571943 de acuerdo a avaluo y tipo de prenda (ROTOMARTILLO prestamo $700)
 --| 
    SELECT * FROM t_empenios_boleta_relacion LEFT JOIN t_empenios ON t_empenios_boleta_relacion.t_empenios_id = t_empenios.id WHERE t_empenios.id = 236634; 
-->> Con esta actualizacion se corrigen las relaciones, pero se tiene que investigar a fondo que empeño si no afecta en pagos y otras tablas
        UPDATE t_empenios_boleta_relacion SET t_boleta_id = 10575026 WHERE id = 236634; 
        UPDATE t_empenios_boleta_relacion SET t_boleta_id = 10571943, t_empenios_id = 236635  WHERE id = 236635; 

-->> se encontro que el t_empenio_id:157911 y 157912 estan invertidos con el id de la tabla t_empenios_boleta_relacion, investigar las boletas 10522796 y 10522794

-->>  t_empenios_boleta_relacion :: verificamos las t_boleta_id que no existen en la tabla t_boletas (~827 registros)
-->> Sin embargo si existen en la tabla t_boleta_cancelado, pero deben de eliminarse para conservar la integridad de la base de datos
    SELECT DISTINCT t_empenios_boleta_relacion.t_boleta_id, t_empenios.id 
    FROM t_empenios_boleta_relacion 
    LEFT JOIN t_boleta ON t_empenios_boleta_relacion.t_boleta_id = t_boleta.id 
    LEFT JOIN t_empenios ON t_empenios_boleta_relacion.t_empenios_id = t_empenios.id 
    WHERE t_boleta.id IS NULL;
        DELETE t_empenios_boleta_relacion 
        FROM t_empenios_boleta_relacion 
        LEFT JOIN t_boleta ON t_empenios_boleta_relacion.t_boleta_id = t_boleta.id 
        LEFT JOIN t_empenios ON t_empenios_boleta_relacion.t_empenios_id = t_empenios.id 
        WHERE t_boleta.id IS NULL; 
    OPTIMIZE TABLE `t_empenios_boleta_relacion`


/*  t_empenios, t_empenios_metal, t_empenios_productos   --------------------------------------------------------------------------------|*/

-->> t_empenios :: se corrigue un error donde 4 registros de t_empenios no tiene un pignorante_id
        UPDATE t_empenios SET u_pignorante_id = 1933 WHERE u_pignorante_id = 27441 AND id IN (144879, 152894,152893,193264); 


-->> t_empenios :: borramos los empeños que no tienen relacion t_empenios_boleta_relacion (~826 registros)
    SELECT t_empenios.id, t_empenios_boleta_relacion.t_empenios_id, t_empenios_boleta_relacion.t_boleta_id 
    FROM    t_empenios
    LEFT JOIN t_empenios_boleta_relacion ON t_empenios_boleta_relacion.t_empenios_id = t_empenios.id
    WHERE t_empenios_boleta_relacion.id IS NULL;
        DELETE t_empenios 
        FROM t_empenios 
        LEFT JOIN t_empenios_boleta_relacion ON t_empenios_boleta_relacion.t_empenios_id = t_empenios.id
        WHERE t_empenios_boleta_relacion.id IS NULL;

        OPTIMIZE TABLE `t_empenios`

-->> t_empenios_metal :: borramos los empeños que no tienen relacion t_empenios_boleta_relacion (~675 registros)
    SELECT * FROM t_empenios_metal LEFT JOIN t_empenios ON t_empenios.id = t_empenios_metal.t_empenios_id WHERE t_empenios.id IS NULL;
    SELECT * FROM t_empenios_metal LEFT JOIN t_empenios_boleta_relacion ON t_empenios_boleta_relacion.t_empenios_id = t_empenios_metal.t_empenios_id
    WHERE t_empenios_boleta_relacion.id IS NULL;
        DELETE t_empenios_metal
        FROM    t_empenios_metal
        LEFT JOIN t_empenios_boleta_relacion ON t_empenios_boleta_relacion.t_empenios_id = t_empenios_metal.t_empenios_id
        WHERE t_empenios_boleta_relacion.id IS NULL;
                    
-->> t_empenios_productos :: borramos los empeños que no tienen relacion t_empenios_boleta_relacion (~115 registros)
    SELECT * FROM t_empenios_productos LEFT JOIN t_empenios_boleta_relacion ON t_empenios_boleta_relacion.t_empenios_id = t_empenios_productos.t_empenios_id WHERE t_empenios_boleta_relacion.t_empenios_id IS NULL; 
        DELETE t_empenios_productos.*
        FROM    t_empenios_productos
        LEFT JOIN t_empenios_boleta_relacion ON t_empenios_boleta_relacion.t_empenios_id = t_empenios_productos.t_empenios_id
        WHERE t_empenios_boleta_relacion.id IS NULL;

-->> Se corrigue un error donde el contenido de un productos no se guardo
        UPDATE t_empenios_productos SET contenido = '1' WHERE t_empenios_productos.id = 236634;


/*  t_control_interno   --------------------------------------------------------------------------------|*/
-->>  t_control_interno :: verificamos los registros que no tienen relacion con t_boleta    (1reg)
    SELECT *  FROM t_control_interno 
    LEFT JOIN t_boleta ON t_control_interno.t_boleta_id = t_boleta.id 
    WHERE t_boleta.id IS null; 
        DELETE t_control_interno  FROM t_control_interno 
        LEFT JOIN t_boleta ON t_control_interno.t_boleta_id = t_boleta.id 
        WHERE t_boleta.id IS null;

/*  t_caja_monto_operador   --------------------------------------------------------------------------------|*/

-->> t_caja_monto_operador :: las ventas en subasta, no guardan el id del operador en la tabla t_caja_monto_operador (20,986 registros)
    SELECT * FROM t_caja_monto_operador WHERE u_operadores_id = 0; 
        UPDATE t_caja_monto_operador SET u_operadores_id = 126 WHERE u_operadores_id = 150000; 
-->> t_caja_monto_operador :: Se corrigue un error donde el monto de la caja rebasa el valor permitido de 8 enteros y 2 decimales (2reg)
    SELECT * FROM t_caja_monto_operador WHERE caja >= 100000000; 
        UPDATE t_caja_monto_operador SET caja = 1000000.00 WHERE caja >= 100000000;
        

/*  t_subasta y c_fecha_subasta   --------------------------------------------------------------------------------|*/

-->> t_subasta :: se corrigue un error donde t_boleta_id es nulo (1reg) 
            DELETE FROM t_subasta WHERE `t_subasta`.`id` = 13739;

-->> Se elimina el registro 407 porque tiene una fecha erronea
            DELETE FROM c_fecha_subasta WHERE id = 407;

/*  t_comprador   y   t_compra_vitrina   --------------------------------------------------------------------------------|*/

-->> el comprador del registro 6 no tiene nombre
            UPDATE `t_comprador` SET `nombre` = 'xxxx' WHERE `t_comprador`.`id` = 6;
        
            UPDATE `t_comprador` SET `rfc` = null WHERE rfc = 'xxx'; 
            UPDATE `t_comprador` SET `rfc` = null WHERE rfc = ''; 

            UPDATE `t_comprador` SET `ife` = null WHERE ife = 'xxx'; 
            UPDATE `t_comprador` SET `ife` = null WHERE ife = ''; 

            UPDATE `t_comprador` SET `curp` = null WHERE curp = 'xxx'; 
            UPDATE `t_comprador` SET `curp` = null WHERE curp = ''; 

            -- id repetido = 3806(se conserva) <--- 3894(eliminamos)
            DELETE FROM t_comprador WHERE `t_comprador`.`id` = 3894;
            UPDATE t_compra_vitrina SET t_comprador_id = 3806 WHERE t_comprador_id = 3894; 
    
  --> t_comprador :: borramos los compradores que no tienen relacion con t_compra_vitrina (~1,000 registros)
    SELECT t_compra_vitrina.t_boleta_id, t_comprador.nombre FROM `t_comprador` LEFT JOIN t_compra_vitrina ON t_compra_vitrina.t_comprador_id = t_comprador.id WHERE t_compra_vitrina.t_comprador_id IS null; 
        DELETE t_comprador FROM t_comprador LEFT JOIN t_compra_vitrina ON t_compra_vitrina.t_comprador_id = t_comprador.id WHERE t_compra_vitrina.t_comprador_id IS null

    -- compradores que no tienen nombre
        UPDATE `t_comprador` SET `nombre` = 'Comprador 6' WHERE `t_comprador`.`id` = 6; 
        UPDATE `t_comprador` SET `nombre` = 'Comprador 9' WHERE `t_comprador`.`id` = 9; 
        UPDATE `t_comprador` SET `nombre` = 'Comprador 143' WHERE `t_comprador`.`id` = 143; 

/*  t_retasas       -------------------------------------------------*/
-->> el id 3220 tiene t_boleta_id = 1 que es invalido
        DELETE FROM t_retasas WHERE `t_retasas`.`id` = 3220;
        
/*  t_concentrados      -------------------------------------------------*/

    SELECT * FROM `t_concentrados` WHERE id_gerente = 0; -->> cambiar id_gerente e id_operador diferente de 0         ids: [24885, 25123, 28282, 29703]
    UPDATE `t_concentrados` SET `id_gerente` = '121' WHERE id_gerente = 0;  

    DELETE FROM t_concentrados WHERE `t_concentrados`.`id` = 24885; -->> todo da cero, mejor eliminamos


/*  t_compra_vitrina        -------------------------------------------------*/
-->> el id 17161 tiene "cantidad" => 5.4714600912857E+15
        UPDATE `t_compra_vitrina` SET `cantidad` = '5610' WHERE `t_compra_vitrina`.`id` = 17161; 
        UPDATE `t_compra_vitrina` SET `cantidad` = '4995' WHERE `t_compra_vitrina`.`id` = 37160; 
        UPDATE `t_compra_vitrina` SET `cantidad` = '1200' WHERE `t_compra_vitrina`.`id` = 41161; 
        UPDATE `t_compra_vitrina` SET `cantidad` = '14742' WHERE `t_compra_vitrina`.`id` = 64178; 

-->> estos registros 23087, 31012 tienen t_boleta_id = null
        DELETE FROM `t_compra_vitrina` WHERE `t_boleta_id` is null;

-->> el id 25380 tiene t_boleta_id = 352735 que no es valido
        DELETE FROM t_compra_vitrina WHERE `t_compra_vitrina`.`id` = 25380;


/*  t_suspencion_dias       -------------------------------------------------*/
-->> t_suspencion_dias :: se corrigue un error donde el id del operador no existe (862) y se cambia por 126
        UPDATE `t_suspencion_dias` SET `u_operadores_id` = 126 WHERE u_operadores_id = 862; 
/*  t_num_tickes        -------------------------------------------------*/
    SELECT * FROM `t_num_tickes` LEFT JOIN t_boleta ON t_num_tickes.t_boleta_id = t_boleta.id WHERE t_boleta.id IS null; 
-->> 2081 y 158375 no tienen t_boleta_id
        DELETE FROM t_num_tickes WHERE `t_num_tickes`.`id` = 2081;
        DELETE FROM t_num_tickes WHERE `t_num_tickes`.`id` = 158375;
       
/*  r_ro_cg11        -------------------------------------------------*/
    DELETE FROM `r_rg_cg11` WHERE (`depositaria_reg_m` + `depositaria_cant_m` + `depositaria_reg_v` + `depositaria_cant_v` + `almoneda_reg_m` + `almoneda_cant_m` + `almoneda_reg_v` +`almoneda_cant_v`) = 0; 
     
    DELETE FROM `r_ro_cg12` WHERE ( `num_desempenio` + `num_reposicion` + `num_refrendos` + `num_empenio` + `num_abono` + `num_venta_subasta` + `num_venta_mostrador` + `num_refrendo_almo` + `num_desempenio_almo` + `num_reposicion_almo` + `num_demasia_almo` ) = 0 AND caja_inicio = 0 AND corte_caja = 0; 

------------------------------------------------- OTRAS ANOMALIAS 
-->> 3 de los pignorantes de t_boleta y t_empenios no coinciden (PORQUE???)
    SELECT t_empenios_boleta_relacion.t_empenios_id,    t_boleta.id, t_boleta.u_pignorante_id,    t_empenios.id,t_empenios.u_pignorante_id 
    FROM `t_empenios_boleta_relacion` 
    INNER JOIN t_boleta ON t_boleta.id = t_empenios_boleta_relacion.t_boleta_id 
    INNER JOIN t_empenios ON t_empenios.id = t_empenios_boleta_relacion.t_empenios_id 
    WHERE t_boleta.u_pignorante_id <> t_empenios.u_pignorante_id; 

-- ANTILLON VIDAL LUISA ELENA  <---->   ROSAS ZARATE JESUS ALFONSO
-- HEREDIA HERNANDEZ WILFRIDO <---->   JOAQUIN JOAQUIN LAURA
-- CRUZ MATEO ANA LUCI <---->   CORTES PEREZ AURELIA



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