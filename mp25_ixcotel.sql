-- Active: 1747336191893@@localhost@3309@mp_ixcotel
$ gunzip -c mp_ixcotel_250430.sql.gz | ./vendor/bin/sail exec -T mysql mysql -u root mp_ixcotel
$ rm mp_ixcotel_250430.sql.gz

DROP TABLE `c_cotiza_producto_08112015`, 
`c_fecha_reporte`, 
`c_intereses`, 
`c_nivel`, 
`c_printer_operador`, 
`c_printer_operador_tipo`, 
`c_productos_08112015`, 
`c_sub_productos_08112015`, 
`c_sucursal_v1`, 
`c_tipo_printer`, 
`c_tipo_producto_08112015`, 
`h_rp_subasta`, 
`rg_dda07`, 
`rg_ddd04`, 
`rg_de02`, 
`rg_dra06`, 
`rg_drd03`, 
`temporal`, 
`t_boetas_pagos_mal_NoVenta`, 
`t_boleta_migracion`, 
`t_control_interno_cancelado`, 
`t_migration_missing`, 
`u_directores`, 
`u_operadores_copy`;

DROP TRIGGER IF EXISTS `t_boleta_cancelar`;
DROP TRIGGER IF EXISTS `t_boleta_historico`;
DROP TRIGGER IF EXISTS `t_boleta_numeroInterno`;
DROP TRIGGER IF EXISTS `suma_totales`;




begin secction
01    --> 151539','ADRIANA VANESSA FRANCO VASQUEZ',             ,'operador_ixc3',    
02    --> 150126','INFORMATICA GERENTE',                        ,'gerente_ui',    
168   --> 151547','RUBI CRISTAL HERNANDEZ TRUJILLO',            ,'operador_valles12',
1535  --> 151539','ADRIANA VANESSA FRANCO VASQUEZ',             ,'operador_ixc3',    
1536  --> 151540','ALVARO LEON MARQUEZ',                        ,'operador_ixc5',    
08    --> 151537','ISAAC JARED LOPEZ JARQUIN',                  ,'operador_ixc2',    
12    --> 151539','ADRIANA VANESSA FRANCO VASQUEZ',             ,'operador_ixc3',    
13    --> 151530','CESAR JOEL NAVARRO ESPINOSA DE LOS MONTERO', ,'operador_ixc4',    
17    --> 151540','ALVARO LEON MARQUEZ',                        ,'operador_ixc5',    
18    --> 151482','LORENA GUADALUPE LEON SILVA ',               ,'operador_ixc6',    
11    --> 151529','LUIS MIGUEL GALEOTE ROSARIO',                ,'operador_valles1', 
15    --> 151490','TOMAS LOPEZ ALEJANDRA',                      ,'operador_rf128',   
16    --> 151473','ESTRELLA MARISOL MORALES',                   ,'operador_rf103',   
20    --> 151507','MARTHA BURGUETE BRENA',                      ,'operador_rf142',   
21    --> 151459','TERESA DE JESUS LOPEZ SANCHEZ',              ,'operador_rf130',   
22    --> 150118','OMAR RAMIREZ PACHECO',                       ,'operador_rf126',   
23    --> 151545','LILIANA PATRICIA MORALES GARCIA',            ,'operador_rf155',   
26    --> 151547','RUBI CRISTAL HERNANDEZ TRUJILLO',            ,'operador_valles12',
27    --> 151461','ISABEL RAMIREZ ROMERO',                      ,'operador_rf101',   
28    --> 151487','JOEL EDUARDO BENITEZ VELASCO',               ,'operador_rf123',   
31    --> 151550','EDGAR HORLANDO SOSA IRIARTE',                ,'operador_rf156',   
32    --> 150131','MIREYA NASHIELLY HERNANDEZ GUZMAN',          ,'operador_rf114',   
33    --> 151511','BEATRIZ VELAZQUEZ CORTES',                   ,'operador_rf145',   
34    --> 151454','JUAN MANUEL FLORES RODRIGUEZ',               ,'operador_rf107',   
35    --> 151552','FILIGONIO HERRERA HERNANDEZ',                ,'operador_rf159',   
37    --> 151460','EDUARDO LOPEZ CHAVEZ',                       ,'operador_rf105',   
33036 --> 330036','ABIMAEL ABRAHAM CARREÑO FLORES',             ,'operador_rf160',   
    UPDATE u_operadores SET id = 151453 WHERE id = 7;
    UPDATE u_operadores SET id = 151537 WHERE id = 8;
    UPDATE u_operadores SET id = 151529 WHERE id = 11;
    UPDATE u_operadores SET id = 151539 WHERE id = 12;
    UPDATE u_operadores SET id = 151530 WHERE id = 13;
    UPDATE u_operadores SET id = 151490 WHERE id = 15;
    UPDATE u_operadores SET id = 151473 WHERE id = 16;
    UPDATE u_operadores SET id = 151540 WHERE id = 17;
    UPDATE u_operadores SET id = 151482 WHERE id = 18;
    UPDATE u_operadores SET id = 151507 WHERE id = 20;
    UPDATE u_operadores SET id = 151459 WHERE id = 21;  
    UPDATE u_operadores SET id = 150118 WHERE id = 22;
    UPDATE u_operadores SET id = 151545 WHERE id = 23;
    UPDATE u_operadores SET id = 151547 WHERE id = 26;
    UPDATE u_operadores SET id = 151461 WHERE id = 27;
    UPDATE u_operadores SET id = 151487 WHERE id = 28;
    UPDATE u_operadores SET id = 151550 WHERE id = 31;
    UPDATE u_operadores SET id = 150131 WHERE id = 32;
    UPDATE u_operadores SET id = 151511 WHERE id = 33;
    UPDATE u_operadores SET id = 151454 WHERE id = 34;
    UPDATE u_operadores SET id = 151552 WHERE id = 35;
    UPDATE u_operadores SET id = 151460 WHERE id = 37;
    UPDATE u_operadores SET id = 330036 WHERE id = 36; 

    UPDATE t_boleta  SET    u_operador_id = 151453   WHERE    u_operador_id = 7;
    UPDATE t_boleta  SET    u_operador_id = 151537   WHERE    u_operador_id = 8;
    UPDATE t_boleta  SET    u_operador_id = 151529   WHERE    u_operador_id = 11;
    UPDATE t_boleta  SET    u_operador_id = 151539   WHERE    u_operador_id = 12;
    UPDATE t_boleta  SET    u_operador_id = 151530   WHERE    u_operador_id = 13;
    UPDATE t_boleta  SET    u_operador_id = 151490   WHERE    u_operador_id = 15;
    UPDATE t_boleta  SET    u_operador_id = 151473   WHERE    u_operador_id = 16;
    UPDATE t_boleta  SET    u_operador_id = 151540   WHERE    u_operador_id = 17;
    UPDATE t_boleta  SET    u_operador_id = 151482   WHERE    u_operador_id = 18;
    UPDATE t_boleta  SET    u_operador_id = 151507   WHERE    u_operador_id = 20;
    UPDATE t_boleta  SET    u_operador_id = 150118   WHERE    u_operador_id = 22;
    UPDATE t_boleta  SET    u_operador_id = 151547   WHERE    u_operador_id = 26;
    UPDATE t_boleta  SET    u_operador_id = 151461   WHERE    u_operador_id = 27;
    UPDATE t_boleta  SET    u_operador_id = 151550   WHERE    u_operador_id = 31;
    UPDATE t_boleta  SET    u_operador_id = 150131   WHERE    u_operador_id = 32;
    UPDATE t_boleta  SET    u_operador_id = 151511   WHERE    u_operador_id = 33;
    UPDATE t_boleta  SET    u_operador_id = 151454   WHERE    u_operador_id = 34;
    UPDATE t_boleta  SET    u_operador_id = 330036   WHERE    u_operador_id = 36;

    UPDATE h_t_boleta SET u_operador_id = 151453   WHERE    u_operador_id = 7;
    UPDATE h_t_boleta SET u_operador_id = 151537   WHERE    u_operador_id = 8;
    UPDATE h_t_boleta SET u_operador_id = 151529   WHERE    u_operador_id = 11;
    UPDATE h_t_boleta SET u_operador_id = 151539   WHERE    u_operador_id = 12;
    UPDATE h_t_boleta SET u_operador_id = 151530   WHERE    u_operador_id = 13;
    UPDATE h_t_boleta SET u_operador_id = 151490   WHERE    u_operador_id = 15;
    UPDATE h_t_boleta SET u_operador_id = 151473   WHERE    u_operador_id = 16;
    UPDATE h_t_boleta SET u_operador_id = 151540   WHERE    u_operador_id = 17;
    UPDATE h_t_boleta SET u_operador_id = 151482   WHERE    u_operador_id = 18;
    UPDATE h_t_boleta SET u_operador_id = 151507   WHERE    u_operador_id = 20;
    UPDATE h_t_boleta SET u_operador_id = 151459   WHERE    u_operador_id = 21;
    UPDATE h_t_boleta SET u_operador_id = 150118   WHERE    u_operador_id = 22;
    UPDATE h_t_boleta SET u_operador_id = 151545   WHERE    u_operador_id = 23;
    UPDATE h_t_boleta SET u_operador_id = 151547   WHERE    u_operador_id = 26;
    UPDATE h_t_boleta SET u_operador_id = 151461   WHERE    u_operador_id = 27;
    UPDATE h_t_boleta SET u_operador_id = 151487   WHERE    u_operador_id = 28;
    UPDATE h_t_boleta SET u_operador_id = 151550   WHERE    u_operador_id = 31;
    UPDATE h_t_boleta SET u_operador_id = 150131   WHERE    u_operador_id = 32;
    UPDATE h_t_boleta SET u_operador_id = 151511   WHERE    u_operador_id = 33;
    UPDATE h_t_boleta SET u_operador_id = 151454   WHERE    u_operador_id = 34;
    UPDATE h_t_boleta SET u_operador_id = 151552   WHERE    u_operador_id = 35;
    UPDATE h_t_boleta SET u_operador_id = 330036   WHERE    u_operador_id = 36;
    UPDATE h_t_boleta SET u_operador_id = 151460   WHERE    u_operador_id = 37;

    UPDATE t_boleta_cancelado  SET    u_operador_id = 151453 WHERE u_operador_id = 7;
    UPDATE t_boleta_cancelado  SET    u_operador_id = 151537 WHERE u_operador_id = 8;
    UPDATE t_boleta_cancelado  SET    u_operador_id = 151539 WHERE u_operador_id = 12;
    UPDATE t_boleta_cancelado  SET    u_operador_id = 151530 WHERE u_operador_id = 13;    
    UPDATE t_boleta_cancelado  SET    u_operador_id = 151547 WHERE u_operador_id = 26;
    UPDATE t_boleta_cancelado  SET    u_operador_id = 151454 WHERE u_operador_id = 34;
    UPDATE t_boleta_cancelado  SET    u_operador_id = 330036 WHERE u_operador_id = 36;

    UPDATE t_caja_monto_operador SET u_operadores_id = 151453 WHERE u_operadores_id = 7;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151537 WHERE u_operadores_id = 8;    
    UPDATE t_caja_monto_operador SET u_operadores_id = 151529 WHERE u_operadores_id = 11;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151539 WHERE u_operadores_id = 12;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151530 WHERE u_operadores_id = 13;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151490 WHERE u_operadores_id = 15;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151473 WHERE u_operadores_id = 16;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151540 WHERE u_operadores_id = 17;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151482 WHERE u_operadores_id = 18;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151507 WHERE u_operadores_id = 20;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151459 WHERE u_operadores_id = 21;
    UPDATE t_caja_monto_operador SET u_operadores_id = 150118 WHERE u_operadores_id = 22;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151545 WHERE u_operadores_id = 23;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151547 WHERE u_operadores_id = 26;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151461 WHERE u_operadores_id = 27;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151487 WHERE u_operadores_id = 28;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151550 WHERE u_operadores_id = 31;
    UPDATE t_caja_monto_operador SET u_operadores_id = 150131 WHERE u_operadores_id = 32;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151511 WHERE u_operadores_id = 33;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151454 WHERE u_operadores_id = 34;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151552 WHERE u_operadores_id = 35;
    UPDATE t_caja_monto_operador SET u_operadores_id = 330036 WHERE u_operadores_id = 36;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151460 WHERE u_operadores_id = 37;

    UPDATE t_suspencion_dias SET u_operadores_id = 150126 WHERE u_operadores_id = 862; 

    UPDATE t_concentrados  SET    id_operador = 151453 WHERE id_operador = 7;
    UPDATE t_concentrados  SET    id_operador = 151537 WHERE id_operador = 8;
    UPDATE t_concentrados  SET    id_operador = 151529 WHERE id_operador = 11;
    UPDATE t_concentrados  SET    id_operador = 151539 WHERE id_operador = 12;
    UPDATE t_concentrados  SET    id_operador = 151530 WHERE id_operador = 13;
    UPDATE t_concentrados  SET    id_operador = 151473 WHERE id_operador = 16;
    UPDATE t_concentrados  SET    id_operador = 151482 WHERE id_operador = 18;
    UPDATE t_concentrados  SET    id_operador = 151547 WHERE id_operador = 26;
    UPDATE t_concentrados  SET    id_operador = 151461 WHERE id_operador = 27;
    UPDATE t_concentrados  SET    id_operador = 151550 WHERE id_operador = 31;
    UPDATE t_concentrados  SET    id_operador = 151454 WHERE id_operador = 34;
    UPDATE t_concentrados  SET    id_operador = 330036 WHERE id_operador = 36;

    -->> tabla vacia: UPDATE t_descuentos  SET    id_operador = 0  WHERE id_operador = 0;

    UPDATE r_ro_cg12    SET    id_operador = 151539 WHERE id_operador = 1;
    UPDATE r_ro_cg12    SET    id_operador = 150126 WHERE id_operador = 2;
    UPDATE r_ro_cg12    SET    id_operador = 151453 WHERE id_operador = 7;
    UPDATE r_ro_cg12    SET    id_operador = 151537 WHERE id_operador = 8;
    UPDATE r_ro_cg12    SET    id_operador = 151529 WHERE id_operador = 11;
    UPDATE r_ro_cg12    SET    id_operador = 151539 WHERE id_operador = 12;
    UPDATE r_ro_cg12    SET    id_operador = 151530 WHERE id_operador = 13;
    UPDATE r_ro_cg12    SET    id_operador = 151490 WHERE id_operador = 15;
    UPDATE r_ro_cg12    SET    id_operador = 151473 WHERE id_operador = 16;
    UPDATE r_ro_cg12    SET    id_operador = 151540 WHERE id_operador = 17;
    UPDATE r_ro_cg12    SET    id_operador = 151482 WHERE id_operador = 18;
    UPDATE r_ro_cg12    SET    id_operador = 151507 WHERE id_operador = 20;
    UPDATE r_ro_cg12    SET    id_operador = 151459 WHERE id_operador = 21;
    UPDATE r_ro_cg12    SET    id_operador = 150118 WHERE id_operador = 22;
    UPDATE r_ro_cg12    SET    id_operador = 151545 WHERE id_operador = 23;
    UPDATE r_ro_cg12    SET    id_operador = 151547 WHERE id_operador = 26;
    UPDATE r_ro_cg12    SET    id_operador = 151461 WHERE id_operador = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151487 WHERE id_operador = 28;
    UPDATE r_ro_cg12    SET    id_operador = 151550 WHERE id_operador = 31;
    UPDATE r_ro_cg12    SET    id_operador = 150131 WHERE id_operador = 32;
    UPDATE r_ro_cg12    SET    id_operador = 151511 WHERE id_operador = 33;
    UPDATE r_ro_cg12    SET    id_operador = 151454 WHERE id_operador = 34;
    UPDATE r_ro_cg12    SET    id_operador = 151552 WHERE id_operador = 35;
    UPDATE r_ro_cg12    SET    id_operador = 330036 WHERE id_operador = 36;
    UPDATE r_ro_cg12    SET    id_operador = 151460 WHERE id_operador = 37;
    UPDATE r_ro_cg12    SET    id_operador = 151547 WHERE id_operador = 168;
    UPDATE r_ro_cg12    SET    id_operador = 151539 WHERE id_operador = 1535;
    UPDATE r_ro_cg12    SET    id_operador = 151540 WHERE id_operador = 1536;

    UPDATE t_reposicion  SET    id_usuario = 151453 WHERE id_usuario = 7;
    UPDATE t_reposicion  SET    id_usuario = 151537 WHERE id_usuario = 8;
    UPDATE t_reposicion  SET    id_usuario = 151529 WHERE id_usuario = 11;
    UPDATE t_reposicion  SET    id_usuario = 151539 WHERE id_usuario = 12;
    UPDATE t_reposicion  SET    id_usuario = 151530 WHERE id_usuario = 13;
    UPDATE t_reposicion  SET    id_usuario = 151547 WHERE id_usuario = 26;
    UPDATE t_reposicion  SET    id_usuario = 151461 WHERE id_usuario = 27;
    UPDATE t_reposicion  SET    id_usuario = 330036 WHERE id_usuario = 36;
end secction;



------------------------------------------------- u_pignotarios 
begin section

 SELECT * FROM `u_pignotarios` WHERE nombre LIKE "%‘%";          
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
    UPDATE u_pignotarios SET nombre = REPLACE(nombre, 'ªª', 'ª');             -- x 5
    UPDATE u_pignotarios SET nombre = REPLACE(nombre, 'ª', 'Ñ'); 
 -- 
    SELECT * FROM `u_pignotarios` WHERE direccion LIKE "%‘%";           
    UPDATE u_pignotarios SET direccion = REPLACE(direccion, 'Âƒ', 'ª');
    UPDATE u_pignotarios SET direccion = REPLACE(direccion, 'Ãƒ', 'ª');
    UPDATE u_pignotarios SET direccion = REPLACE(direccion, 'Ã‚', 'ª'); 
    UPDATE u_pignotarios SET direccion = REPLACE(direccion, 'Â‘', 'ª'); 
    UPDATE u_pignotarios SET direccion = REPLACE(direccion, 'Ã‘', 'ª'); 
    UPDATE u_pignotarios SET direccion = REPLACE(direccion, 'ªª', 'ª');     -- x 3
    UPDATE u_pignotarios SET direccion = REPLACE(direccion, 'ª', 'Ñ'); 
end section


begin section
 -- 🔃 actualizamos todo a mayusculas, quitamos espacions dobles y eliminamos espacion en blanco al inicio y al final de los nombres
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = UPPER(pignorante_solidario); 
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, '  ', ' ');    -- x 4
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'NADIE', ''); 
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = TRIM(pignorante_solidario); 

    
 -- 👀 Revisamos los registros de pignorante_solidarios NO sean nombres invalidos, para ser eliminados
    SELECT pignorante_solidario, COUNT(t_boleta_id) FROM u_pignotarios_solidarios WHERE LENGTH(pignorante_solidario) < 10 GROUP BY pignorante_solidario; 
        DELETE FROM u_pignotarios_solidarios WHERE LENGTH(pignorante_solidario) < 10;       --APROX ~1151
    SELECT DISTINCT pignorante_solidario FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '% DEJA%'; 
        DELETE FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '% DEJA%' AND LENGTH(pignorante_solidario) < 18;
    SELECT DISTINCT pignorante_solidario FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '% MIS%' AND LENGTH(pignorante_solidario) < 16; 
        DELETE FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '% MIS%' AND LENGTH(pignorante_solidario) < 16;
    SELECT DISTINCT pignorante_solidario FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '%EL M%' AND LENGTH(pignorante_solidario) < 12; 
        DELETE FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '%EL M%' AND LENGTH(pignorante_solidario) < 12;  
    SELECT DISTINCT pignorante_solidario FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '%ELLA%' AND LENGTH(pignorante_solidario) < 15;
        DELETE FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '%ELLA%' AND LENGTH(pignorante_solidario) < 15;   
    SELECT DISTINCT pignorante_solidario FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '% MISMO%'; 
        DELETE FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '% MISMO%'; 
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
        UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'ªª', 'ª');    -- x3
    SELECT * FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '%ª%';           
        UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'ª', 'Ñ'); 
end section 

------------------------------------------------- t_boleta


------------------------------------------------- Catalogos
begin section


    UPDATE `c_municipios` SET `sigla` = 'ACÑ' WHERE id = 34; 
    UPDATE `c_municipios` SET `sigla` = 'SJPÑ' WHERE id = 1165; 
    UPDATE `c_municipios` SET `sigla` = 'SAJÑ' WHERE id = 1208; 
    UPDATE `c_municipios` SET `sigla` = 'SMPÑ' WHERE id = 1250; 
    UPDATE `c_municipios` SET `sigla` = 'SMÑ' WHERE id = 1251; 
    UPDATE `c_municipios` SET `sigla` = 'SACÑ' WHERE id = 1688; 
    UPDATE `c_municipios` SET `sigla` = 'GÜÉ' WHERE id = 1991; 

    UPDATE c_municipios SET nombre = REPLACE(nombre, 'Ã‘', 'Ñ'); 
    UPDATE c_municipios SET nombre = REPLACE(nombre, 'Ã±', 'ñ'); 
    UPDATE c_municipios SET nombre = REPLACE(nombre, 'Ã', 'Á'); 
    UPDATE c_municipios SET nombre = REPLACE(nombre, 'Ã¡', 'á'); 
    UPDATE c_municipios SET nombre = REPLACE(nombre, 'Ã©', 'é'); 
    UPDATE c_municipios SET nombre = REPLACE(nombre, 'Ã³', 'ó'); 
    UPDATE c_municipios SET nombre = REPLACE(nombre, 'Ãº', 'ú'); 
    UPDATE c_municipios SET nombre = REPLACE(nombre, 'Ã¼', 'ü'); 
    UPDATE c_municipios SET nombre = REPLACE(nombre, 'Ã­', 'í'); 
            

            
            -- Cambio temporal de id de subproductos
            -- 596 por 332
            -- UPDATE t_empenios SET c_sub_productos_id = '332' WHERE t_empenios.id = 2626; 
            -- UPDATE t_empenios SET c_sub_productos_id = '332' WHERE t_empenios.id = 2627; 
            -- 597 por 471
end section
