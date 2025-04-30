DROP TABLE 
    `c_cotiza_producto_08112015`, 
    `c_printer_operador`, 
    `c_printer_operador_tipo`, 
    `c_productos_08112015`, 
    `c_sub_productos_08112015`, 
    `c_sucursal_v1`, 
    `c_tipo_producto_08112015`, 
    `migration_boletas`, 
    `rg_dda07`, 
    `rg_ddd04`, 
    `rg_de02`, 
    `rg_dra06`, 
    `rg_drd03`, 
    `t_boetas_pagos_mal_NoVenta`, 
    `t_migration_missing`,
    `c_fecha_reporte`, 
    `c_tipo_printer`, 
    `h_rp_subasta`, 
    `u_directores`, 
    `u_operadores_copy`,
    `c_estados`, 
    `c_municipios`, 
    `c_nivel`, 
    `temporal`;


------------------------------------------------- u_operadores 
    UPDATE u_operadores SET nombre = TRIM(nombre);
    UPDATE u_operadores SET nombre = UPPER(nombre);
-- BORRAMOS OPERADOR REPETIDO -- 
    DELETE FROM u_operadores WHERE `u_operadores`.`id` = 1529
-- Agregamos la sucursal al ID
    UPDATE u_operadores SET id = id + 270000; 
    UPDATE t_boleta SET u_operador_id = u_operador_id + 270000; 
    UPDATE h_t_boleta SET u_operador_id = u_operador_id + 270000; 
    UPDATE t_boleta_cancelado  SET    u_operador_id = u_operador_id + 270000;
    UPDATE t_caja_monto_operador  SET    u_operadores_id = u_operadores_id + 270000;
    UPDATE t_suspencion_dias  SET    u_operadores_id = u_operadores_id + 270000;
    UPDATE t_concentrados  SET    id_operador = id_operador + 270000;
    UPDATE t_descuentos  SET    id_operador = id_operador + 270000;
    UPDATE r_ro_cg12  SET    id_operador = id_operador + 270000;
    UPDATE t_reposicion  SET    id_usuario = id_usuario + 270000;
    

UPDATE t_cajas SET user_id = 1537 WHERE user_id = 8,
UPDATE t_cajas SET user_id = 1453 WHERE user_id = 7,
UPDATE t_cajas SET user_id = 1529 WHERE user_id = 11,
UPDATE t_cajas SET user_id = 1539 WHERE user_id = 12,
UPDATE t_cajas SET user_id = 1530 WHERE user_id = 13,
UPDATE t_cajas SET user_id = 1490 WHERE user_id = 15,
UPDATE t_cajas SET user_id = 1473 WHERE user_id = 16,
UPDATE t_cajas SET user_id = 1540 WHERE user_id = 17,
UPDATE t_cajas SET user_id = 1482 WHERE user_id = 18,
UPDATE t_cajas SET user_id = 1507 WHERE user_id = 20,
UPDATE t_cajas SET user_id = 1459 WHERE user_id = 21,
UPDATE t_cajas SET user_id = 118 WHERE user_id = 22,
UPDATE t_cajas SET user_id = 1545 WHERE user_id = 23,
UPDATE t_cajas SET user_id = 1547 WHERE user_id = 26,
UPDATE t_cajas SET user_id = 1461 WHERE user_id = 27,
UPDATE t_cajas SET user_id = 1487 WHERE user_id = 28,
UPDATE t_cajas SET user_id = 1550 WHERE user_id = 31,
UPDATE t_cajas SET user_id = 131 WHERE user_id = 32,
UPDATE t_cajas SET user_id = 1511 WHERE user_id = 33,
UPDATE t_cajas SET user_id = 1454 WHERE user_id = 34,
UPDATE t_cajas SET user_id = 1552 WHERE user_id = 35,
UPDATE t_cajas SET user_id = 33036 WHERE user_id = 36,
UPDATE t_cajas SET user_id = 1460 WHERE user_id = 37;


-------------------------------------------------> t_empenios 
-- borramos los empeños que no tienen relacion t_empenios_boleta_relacion (~61 registros)
 📌 SELECT t_empenios.*
        FROM    t_empenios
        LEFT JOIN t_empenios_boleta_relacion ON t_empenios_boleta_relacion.t_empenios_id = t_empenios.id
        WHERE t_empenios_boleta_relacion.id IS NULL;
 ❌ DELETE t_empenios 
        FROM t_empenios 
        LEFT JOIN t_empenios_boleta_relacion ON t_empenios_boleta_relacion.t_empenios_id = t_empenios.id
        WHERE t_empenios_boleta_relacion.id IS NULL;

------------------------------------------------- u_pignotarios 
    UPDATE u_pignotarios SET nombre = TRIM(nombre);
    SELECT * FROM `u_pignotarios` WHERE nombre LIKE "%‘%";
    UPDATE u_pignotarios SET nombre = REPLACE(nombre, 'Ãƒ', 'ª'),
    UPDATE u_pignotarios SET nombre = REPLACE(nombre, 'Âƒ', 'ª'),
    UPDATE u_pignotarios SET nombre = REPLACE(nombre, 'Ã‘', 'ª'),
    UPDATE u_pignotarios SET nombre = REPLACE(nombre, 'Â‘', 'ª'),
    UPDATE u_pignotarios SET nombre = REPLACE(nombre, 'Ã‚', 'ª'),
    UPDATE u_pignotarios SET nombre = REPLACE(nombre, 'Â‚', 'ª'),
    UPDATE u_pignotarios SET nombre = REPLACE(nombre, 'ªª', 'ª'),
    UPDATE u_pignotarios SET nombre = REPLACE(nombre, 'ª', 'Ñ'),
    Ã‚Âƒ        --> id 609 	

------------------------------------------------- pignorante_solidario
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = TRIM(pignorante_solidario);
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = UPPER(pignorante_solidario);
    SELECT * FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '%‘%';
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'Âƒ', 'ª'),
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'Ãƒ', 'ª'),
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'Â‚', 'ª'),
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'Ã‚', 'ª'),
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'Â‘', 'ª'),
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'Ã‘', 'ª'),
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'ªª', 'ª')  
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'ª', 'Ñ');

    SELECT pignorante_solidario, COUNT(t_boleta_id) FROM u_pignotarios_solidarios WHERE LENGTH(pignorante_solidario) < 9 GROUP BY pignorante_solidario; 
    DELETE FROM u_pignotarios_solidarios WHERE LENGTH(pignorante_solidario) < 9 ;
    UPDATE `u_pignotarios_solidarios` SET `pignorante_solidario` = 'NO DEJA* 9513160844 C DICICION DE ORIENTE 404 BARR EX MARQUEZADO' WHERE `u_pignotarios_solidarios`.`id` = 4431; 
    UPDATE `u_pignotarios_solidarios` SET `pignorante_solidario` = 'NO DEJA* 9513160844 C DICICION DE ORIENTE 404 BARR EX MARQUEZADO' WHERE `u_pignotarios_solidarios`.`id` = 4432; 
    UPDATE `u_pignotarios_solidarios` SET `pignorante_solidario` = 'NO DEJA C DICICION DE ORIENTE 404 BARR EX MARQUEZADO' WHERE `u_pignotarios_solidarios`.`id` = 3008; 
    UPDATE `u_pignotarios_solidarios` SET `pignorante_solidario` = 'NO DEJA C DICICION DE ORIENTE 404 BARR EX MARQUEZADO' WHERE `u_pignotarios_solidarios`.`id` = 3052; 
    UPDATE `u_pignotarios_solidarios` SET `pignorante_solidario` = 'NO DEJA C DICICION DE ORIENTE 404 BARR EX MARQUEZADO' WHERE `u_pignotarios_solidarios`.`id` = 3104; 
    UPDATE `u_pignotarios_solidarios` SET `pignorante_solidario` = 'NO DEJA C DICICION DE ORIENTE 404 BARR EX MARQUEZADO' WHERE `u_pignotarios_solidarios`.`id` = 4316; 
    UPDATE `u_pignotarios_solidarios` SET `pignorante_solidario` = 'NO DEJA C LOMA BONITA 207 COL SIETE REGIONES' WHERE `u_pignotarios_solidarios`.`id` = 2421; 
    UPDATE `u_pignotarios_solidarios` SET `pignorante_solidario` = 'NO DEJA C LOMA BONITA 207 COL SIETE REGIONES' WHERE `u_pignotarios_solidarios`.`id` = 5750; 
------------------------------------------------- t_boletas
-- Se corrige fechas en 0000-00-00
    UPDATE `t_boleta` SET `fecha_limite_pago` = '2021-03-02' WHERE `t_boleta`.`id` = 10009023; 

------------------------------------------------- h_t_boletas
-- Se corrige fechas en 0000-00-00
    UPDATE `h_t_boleta` SET `fecha_limite_pago` = '2021-03-02' WHERE `h_t_boleta`.`id_interno` = 73663; 
    UPDATE `h_t_boleta` SET `fecha_limite_pago` = '2021-02-27' WHERE `h_t_boleta`.`id_interno` = 42517; 