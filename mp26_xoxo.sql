-- Active: 1747336191893@@localhost@3309@mp_xoxo26
-- terminal de vscode
gunzip -c /mnt/c/Users/Dell/Downloads/BD_30_abril/mp_xoxo26_250430.gz | ./vendor/bin/sail exec -T mysql mysql -u root mp_xoxo26


    DROP TABLE `c_intereses`, `c_nivel`, `h_rp_subasta`, `rg_dda07`, `rg_ddd04`, `rg_de02`, `rg_dra06`, `rg_drd03`, `temporal`, `t_boleta_migracion`, `t_control_interno_cancelado`, `t_migration_missing`, `u_directores`;
    DROP VIEW `boleta`
    DROP TRIGGER IF EXISTS t_boleta_cancelar;
    DROP TRIGGER IF EXISTS t_boleta_historico;
    DROP TRIGGER IF EXISTS t_boleta_numeroInterno;
    DROP TRIGGER IF EXISTS suma_totales;


------------------------------------------> CATALOGOS
    UPDATE `c_municipios` SET `sigla` = REPLACE(sigla,"Ãƒ","Ñ"); 
    UPDATE `c_municipios` SET `sigla` = REPLACE(sigla,"Ã","Ñ"); 
    UPDATE `c_municipios` SET `sigla` = REPLACE(sigla,"GÑÂ","GÜÉ"); 

    UPDATE c_productos SET nombre = UPPER(nombre) WHERE 1;
    UPDATE c_productos SET nombre = TRIM(nombre) WHERE 1;

    -- ~464 registros que no se ocuparon en t_empenios
    DELETE c_sub_productos FROM c_sub_productos LEFT JOIN t_empenios ON t_empenios.c_sub_productos_id = c_sub_productos.id 
    WHERE t_empenios.id IS NULL;
    -- ~422 registros eliminados que no tienen subproductos
    DELETE c_cotiza_producto FROM c_cotiza_producto LEFT JOIN c_sub_productos  ON c_cotiza_producto.c_sub_productos_id = c_sub_productos.id 
    WHERE c_sub_productos.id IS NULL;
    UPDATE c_sub_productos SET subproducto = UPPER(subproducto);
    UPDATE c_sub_productos SET subproducto = TRIM(subproducto); 
    UPDATE c_sub_productos SET subproducto = REPLACE(subproducto, 'Ã‘', 'Ñ'); 
    UPDATE c_sub_productos SET subproducto = REPLACE(subproducto, 'Ã', 'Á');     

    UPDATE `c_sub_productos` SET `c_producto_id` = 326 WHERE `c_sub_productos`.`id` = 549; 
    UPDATE `c_sub_productos` SET `id` = 610 WHERE `c_sub_productos`.`id` = 608; 
    UPDATE `t_empenios` SET `c_sub_productos_id` = 610 WHERE `c_sub_productos_id` = 608; 
    
    DELETE FROM c_tipo_prestamo_sucursal WHERE c_sucursal_id != 34; 

    UPDATE c_tipo_prestamo SET clave = 26 WHERE c_tipo_prestamo.clave = 24; 
    UPDATE c_tipo_prestamo SET clave = 25 WHERE c_tipo_prestamo.clave = 23; 
    UPDATE c_tipo_prestamo SET clave = 24 WHERE c_tipo_prestamo.clave = 22; 

    UPDATE t_empenios SET c_tipo_prestamo = 26 WHERE c_tipo_prestamo = 24;    --0 registros
    UPDATE t_empenios SET c_tipo_prestamo = 25 WHERE c_tipo_prestamo = 23;    --0 registros
    UPDATE t_empenios SET c_tipo_prestamo = 24 WHERE c_tipo_prestamo = 22;    --0 registros

    UPDATE c_tipo_prestamo_sucursal SET c_tipo_prestamo = '26' WHERE c_tipo_prestamo_sucursal.id = 51;  --0 registros
    UPDATE c_tipo_prestamo_sucursal SET c_tipo_prestamo = '25' WHERE c_tipo_prestamo_sucursal.id = 50;  --0 registros
    UPDATE c_tipo_prestamo_sucursal SET c_tipo_prestamo = '24' WHERE c_tipo_prestamo_sucursal.id = 49;  --0 registros



------------------------------------------> u_operadores
    UPDATE u_operadores SET nombre = UPPER(nombre) WHERE 1;
    UPDATE u_operadores SET nombre = TRIM(nombre) WHERE 1;
    UPDATE u_operadores SET usuario = TRIM(usuario) WHERE 1;
    UPDATE t_suspencion_dias  SET    u_operadores_id = 150126 WHERE u_operadores_id = 862;

    -- marcamos a los operadores que  tienen registros en otras tablas
    UPDATE u_operadores AS u
    SET genero = 100
    WHERE EXISTS (SELECT 1 FROM t_boleta           b  WHERE b.u_operador_id   = u.id)
    OR EXISTS (SELECT 1 FROM h_t_boleta            h  WHERE h.u_operador_id   = u.id)
    OR EXISTS (SELECT 1 FROM t_boleta_cancelado    c  WHERE c.u_operador_id   = u.id)
    OR EXISTS (SELECT 1 FROM t_caja_monto_operador m  WHERE m.u_operadores_id = u.id)
    OR EXISTS (SELECT 1 FROM t_suspencion_dias     s  WHERE s.u_operadores_id = u.id)
    OR EXISTS (SELECT 1 FROM t_concentrados        t  WHERE t.id_operador     = u.id)
    OR EXISTS (SELECT 1 FROM t_concentrados        t2 WHERE t2.id_gerente     = u.id)
    OR EXISTS (SELECT 1 FROM t_descuentos          d  WHERE d.id_operador     = u.id)
    OR EXISTS (SELECT 1 FROM r_ro_cg12             p  WHERE p.id_operador     = u.id)
    OR EXISTS (SELECT 1 FROM t_reposicion          r  WHERE r.id_usuario      = u.id)
 
 -- Se eliminan registros de operadores que no tienen relacion alguna ~37
    DELETE FROM u_operadores WHERE genero < 100; 

    UPDATE u_operadores SET id = 150126 WHERE id = 2;
    UPDATE u_operadores SET id = 151487 WHERE id = 7;
    UPDATE u_operadores SET id = 151453 WHERE id = 8;
    UPDATE u_operadores SET id = 151461 WHERE id = 11;
    UPDATE u_operadores SET id = 151524 WHERE id = 12;
    UPDATE u_operadores SET id = 151454 WHERE id = 15;
    UPDATE u_operadores SET id = 151482 WHERE id = 16;
    UPDATE u_operadores SET id = 151550 WHERE id = 17;
    UPDATE u_operadores SET id = 151476 WHERE id = 19;
    UPDATE u_operadores SET id = 151552 WHERE id = 21;
    UPDATE u_operadores SET id = 150131 WHERE id = 23;
    UPDATE u_operadores SET id = 150118 WHERE id = 24;
    UPDATE u_operadores SET id = 151539 WHERE id = 27;
    UPDATE u_operadores SET id = 151507 WHERE id = 30;
    UPDATE u_operadores SET id = 151557 WHERE id = 32;
    UPDATE u_operadores SET id = id + 1260000 WHERE id = 13;
    DELETE FROM u_operadores  WHERE id = 6;

    UPDATE t_boleta  SET    u_operador_id = 151487 WHERE u_operador_id = 7;
    UPDATE t_boleta  SET    u_operador_id = 151453 WHERE u_operador_id = 8;
    UPDATE t_boleta  SET    u_operador_id = 151461 WHERE u_operador_id = 11;
    UPDATE t_boleta  SET    u_operador_id = 151524 WHERE u_operador_id = 12;
    UPDATE t_boleta  SET    u_operador_id = 151482 WHERE u_operador_id = 16;
    UPDATE t_boleta  SET    u_operador_id = 151550 WHERE u_operador_id = 17;
    UPDATE t_boleta  SET    u_operador_id = 151476 WHERE u_operador_id = 19;
    UPDATE t_boleta  SET    u_operador_id = 151552 WHERE u_operador_id = 21;
    UPDATE t_boleta  SET    u_operador_id = 150131 WHERE u_operador_id = 23;
    UPDATE t_boleta  SET    u_operador_id = 150118 WHERE u_operador_id = 24;
    UPDATE t_boleta  SET    u_operador_id = 151539 WHERE u_operador_id = 27;
    UPDATE t_boleta  SET    u_operador_id = 151557 WHERE u_operador_id = 32;
    UPDATE t_boleta  SET    u_operador_id = u_operador_id + 1260000 WHERE u_operador_id = 13;

    UPDATE h_t_boleta SET u_operador_id = 151487 WHERE u_operador_id = 7;
    UPDATE h_t_boleta SET u_operador_id = 151453 WHERE u_operador_id = 8;
    UPDATE h_t_boleta SET u_operador_id = 151461 WHERE u_operador_id = 11;
    UPDATE h_t_boleta SET u_operador_id = 151524 WHERE u_operador_id = 12;
    UPDATE h_t_boleta SET u_operador_id = 151454 WHERE u_operador_id = 15;
    UPDATE h_t_boleta SET u_operador_id = 151482 WHERE u_operador_id = 16;
    UPDATE h_t_boleta SET u_operador_id = 151550 WHERE u_operador_id = 17;
    UPDATE h_t_boleta SET u_operador_id = 151476 WHERE u_operador_id = 19;
    UPDATE h_t_boleta SET u_operador_id = 151552 WHERE u_operador_id = 21;
    UPDATE h_t_boleta SET u_operador_id = 150131 WHERE u_operador_id = 23;
    UPDATE h_t_boleta SET u_operador_id = 150118 WHERE u_operador_id = 24;
    UPDATE h_t_boleta SET u_operador_id = 151539 WHERE u_operador_id = 27;
    UPDATE h_t_boleta SET u_operador_id = 151507 WHERE u_operador_id = 30;
    UPDATE h_t_boleta SET u_operador_id = 151557 WHERE u_operador_id = 32;
    UPDATE h_t_boleta SET u_operador_id = u_operador_id + 1260000 WHERE u_operador_id = 13;

    UPDATE t_boleta_cancelado SET u_operador_id = 151487 WHERE u_operador_id = 7;
    UPDATE t_boleta_cancelado SET u_operador_id = 151550 WHERE u_operador_id = 17;
    UPDATE t_boleta_cancelado SET u_operador_id = 151557 WHERE u_operador_id = 1557;

    UPDATE t_caja_monto_operador SET u_operadores_id = 151487 WHERE u_operadores_id = 7;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151453 WHERE u_operadores_id = 8;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151461 WHERE u_operadores_id = 11;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151524 WHERE u_operadores_id = 12;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151454 WHERE u_operadores_id = 15;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151482 WHERE u_operadores_id = 16;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151550 WHERE u_operadores_id = 17;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151476 WHERE u_operadores_id = 19;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151552 WHERE u_operadores_id = 21;
    UPDATE t_caja_monto_operador SET u_operadores_id = 150131 WHERE u_operadores_id = 23;
    UPDATE t_caja_monto_operador SET u_operadores_id = 150118 WHERE u_operadores_id = 24;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151539 WHERE u_operadores_id = 27;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151507 WHERE u_operadores_id = 30;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151557 WHERE u_operadores_id = 32;
    UPDATE t_caja_monto_operador SET u_operadores_id = u_operadores_id + 1260000 WHERE u_operadores_id = 13;


    UPDATE t_concentrados  SET    id_operador = 151487 WHERE id_operador = 7;
    UPDATE t_concentrados  SET    id_operador = 151453 WHERE id_operador = 8;
    UPDATE t_concentrados  SET    id_operador = 151461 WHERE id_operador = 11;
    UPDATE t_concentrados  SET    id_operador = 151524 WHERE id_operador = 12;
    UPDATE t_concentrados  SET    id_operador = 151454 WHERE id_operador = 15;
    UPDATE t_concentrados  SET    id_operador = 151482 WHERE id_operador = 16;
    UPDATE t_concentrados  SET    id_operador = 151550 WHERE id_operador = 17;
    UPDATE t_concentrados  SET    id_operador = 151476 WHERE id_operador = 19;
    UPDATE t_concentrados  SET    id_operador = 151552 WHERE id_operador = 21;
    UPDATE t_concentrados  SET    id_operador = 151557 WHERE id_operador = 32;
    UPDATE t_concentrados  SET    id_gerente = 151482 WHERE id_gerente = 6;
    UPDATE t_concentrados  SET    id_operador = id_operador + 1260000 WHERE id_operador = 13;

    -- UPDATE t_descuentos  SET    id_operador = 151482 WHERE id_operador = 6;

    UPDATE r_ro_cg12    SET    id_operador = 151487 WHERE id_operador = 7;
    UPDATE r_ro_cg12    SET    id_operador = 151453 WHERE id_operador = 8;
    UPDATE r_ro_cg12    SET    id_operador = 151461 WHERE id_operador = 11;
    UPDATE r_ro_cg12    SET    id_operador = 151524 WHERE id_operador = 12;
    UPDATE r_ro_cg12    SET    id_operador = 151454 WHERE id_operador = 15;
    UPDATE r_ro_cg12    SET    id_operador = 151482 WHERE id_operador = 16;
    UPDATE r_ro_cg12    SET    id_operador = 151550 WHERE id_operador = 17;
    UPDATE r_ro_cg12    SET    id_operador = 151476 WHERE id_operador = 19;
    UPDATE r_ro_cg12    SET    id_operador = 151552 WHERE id_operador = 21;
    UPDATE r_ro_cg12    SET    id_operador = 150131 WHERE id_operador = 23;
    UPDATE r_ro_cg12    SET    id_operador = 150118 WHERE id_operador = 24;
    UPDATE r_ro_cg12    SET    id_operador = 151539 WHERE id_operador = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151507 WHERE id_operador = 30;
    UPDATE r_ro_cg12    SET    id_operador = 151557 WHERE id_operador = 32;
    UPDATE r_ro_cg12    SET    id_operador = id_operador + 1260000 WHERE id_operador = 13;

    UPDATE t_reposicion  SET    id_usuario = 151487 WHERE id_usuario = 7;
    UPDATE t_reposicion  SET    id_usuario = 151550 WHERE id_usuario = 17;
    UPDATE t_reposicion  SET    id_usuario = 151552 WHERE id_usuario = 21;

    -- Inserta usuario de informatica
___________________________________________________________________________________________________

 ------------------------------------------> u_pignotarios
    UPDATE u_pignotarios SET nombre = TRIM(nombre);
    SELECT * FROM `u_pignotarios` WHERE nombre LIKE "%‘%";  -- 0 registros

------------------------------------------> u_pignotariosu_pignotarios
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = UPPER(pignorante_solidario) WHERE 1;
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = TRIM(pignorante_solidario) WHERE 1;
    SELECT * FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '%‘%';
    
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'Âƒ', 'ª');
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'Ãƒ', 'ª');
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'Ã‚', 'ª');
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'Â‘', 'ª');
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'Ã‘', 'ª');
    SELECT * FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '%ª%';
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'ªª', 'ª');      --x2
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'ª', 'Ñ');

    SELECT pignorante_solidario, COUNT(t_boleta_id) FROM u_pignotarios_solidarios WHERE LENGTH(pignorante_solidario) < 9 GROUP BY pignorante_solidario; 
    DELETE FROM u_pignotarios_solidarios WHERE LENGTH(pignorante_solidario) < 9 ;
    -- Con esta consulta se verifica si hay pignorantes_solidarios que no tienen boleta asociada
    SELECT * FROM u_pignotarios_solidarios LEFT JOIN t_boleta ON t_boleta.id = u_pignotarios_solidarios.t_boleta_id WHERE t_boleta.id IS null; 
    -- Se eliminan los pignorantes_solidarios que no tienen boleta asociada: ~6 registros
    DELETE u_pignotarios_solidarios FROM u_pignotarios_solidarios LEFT JOIN t_boleta ON t_boleta.id = u_pignotarios_solidarios.t_boleta_id WHERE t_boleta.id IS NULL; 










