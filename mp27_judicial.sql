gunzip -c /mnt/c/Users/Dell/Downloads/BD_30_abril/mp_judicial_250430.gz | ./vendor/bin/sail exec -T mysql mysql -u root mp_27judicial

begin section;

DROP TABLE 
    `c_cotiza_producto_08112015`,    `c_printer_operador`,          `c_printer_operador_tipo`,     
    `c_productos_08112015`,         `c_sub_productos_08112015`,     `c_sucursal_v1`, 
    `c_tipo_producto_08112015`,     `migration_boletas`,            `rg_dda07`, 
    `rg_ddd04`,                     `rg_de02`,                      `rg_dra06`, 
    `rg_drd03`,                     `t_boetas_pagos_mal_NoVenta`,   `t_migration_missing`,
    `c_fecha_reporte`,              `c_tipo_printer`,               `h_rp_subasta`, 
    `u_directores`,                 `u_operadores_copy`,            `c_nivel`, 
    `temporal`,                     `c_tipo_metal`,                 `c_intereses`;

DROP TRIGGER IF EXISTS `t_boleta_cancelar`;
DROP TRIGGER IF EXISTS `t_boleta_historico`;
DROP TRIGGER IF EXISTS `t_boleta_numeroIntern`;
DROP TRIGGER IF EXISTS `suma_totales`;

------------------------------------------------- CATALOGOS

    -- INSERT INTO `c_tipo_producto`(`id`, `tipo`)          VALUES 
    --         (144, 'DISPOSITIVO ELECTRONICO' ), 
    --         (145, 'EQUIPOS SEMI INDUSTRIALES' ), 
    --         (146, 'EQUIPOS ELECTRICOS' ); 

-- 🧹 Limpiamos ~406 registros de la tabla c_sub_productos que no se ocuparon en t_empenios
    DELETE c_sub_productos FROM c_sub_productos LEFT JOIN t_empenios ON t_empenios.c_sub_productos_id = c_sub_productos.id WHERE t_empenios.id IS NULL;
-- 🧹 Limpiamos ~377 registros de la tabla c_cotiza_producto que no se ocuparon en c_sub_productos
    DELETE c_cotiza_producto FROM c_cotiza_producto LEFT JOIN c_sub_productos  ON c_cotiza_producto.c_sub_productos_id = c_sub_productos.id WHERE c_sub_productos.id IS NULL;

    SELECT * FROM `c_productos` LEFT JOIN c_sub_productos ON c_sub_productos.c_producto_id = c_productos.id WHERE c_sub_productos.id IS NULL; 

    UPDATE c_productos SET nombre = UPPER(nombre);

    UPDATE `c_productos` SET `nombre` = 'CAÑADA' WHERE `c_productos`.`id` = 342; 
    UPDATE `c_productos` SET `nombre` = 'MIXTECA TRIQUI' WHERE `c_productos`.`id` = 343; 
    UPDATE `c_productos` SET `nombre` = 'BICICLETA' WHERE `c_productos`.`id` = 348; 
    UPDATE `c_productos` SET `c_tipo_producto_id` = '136' WHERE `c_productos`.`id` = 351; 
    UPDATE `c_productos` SET `nombre` = 'CONSOLA XBOX' WHERE `c_productos`.`id` = 372; 
    UPDATE `c_productos` SET `nombre` = 'VIOLONCHELO' WHERE `c_productos`.`id` = 375; 

    DELETE FROM c_productos WHERE `c_productos`.`id` IN (349, 381, 382, 383);


            UPDATE c_sub_productos SET subproducto = UPPER(subproducto);

            UPDATE c_sub_productos SET subproducto = 'MONTAÑA ' WHERE c_sub_productos.id = 75; 
            UPDATE c_sub_productos SET c_producto_id = 193 WHERE c_producto_id = 191; 
            DELETE FROM c_sub_productos WHERE c_sub_productos.id = 210

            -- CREATE TABLE c_sub_productos_backup AS SELECT * FROM c_sub_productos;
            -- CREATE TABLE t_empenios_backup AS SELECT * FROM t_empenios;

            UPDATE c_sub_productos SET id = id + 1 WHERE id >= 377 ORDER BY id DESC; 
            UPDATE t_empenios SET c_sub_productos_id = c_sub_productos_id + 1 WHERE c_sub_productos_id >= 377; 
            UPDATE c_cotiza_producto SET c_sub_productos_id = c_sub_productos_id + 1 WHERE c_sub_productos_id >= 377; 

            UPDATE c_sub_productos SET id = id + 1 WHERE id >= 508 ORDER BY id DESC; 
            UPDATE t_empenios SET c_sub_productos_id = c_sub_productos_id + 1 WHERE c_sub_productos_id >= 508; 
            
            -- revisar bien si el desface es correcto
            UPDATE c_cotiza_producto SET c_sub_productos_id = c_sub_productos_id + 1 WHERE c_sub_productos_id >= 508; 
            UPDATE c_cotiza_producto SET id = id + 1 WHERE id >= 408 ORDER BY id DESC; 


-- se eliminan registros no validos debido a que su c_sub_productos_id = 0
    SELECT * FROM `t_empenios` INNER JOIN t_empenios_boleta_relacion ON t_empenios_boleta_relacion.t_empenios_id = t_empenios.id INNER JOIN t_boleta ON t_boleta.id = t_empenios_boleta_relacion.t_boleta_id WHERE `t_empenios`.`c_sub_productos_id` =0;
        DELETE FROM t_empenios WHERE `t_empenios`.`id` = 1914;
            DELETE FROM t_empenios_metal WHERE `t_empenios_metal`.`t_empenios_id` = 1914
        DELETE FROM t_empenios WHERE `t_empenios`.`id` = 2476;
            DELETE FROM t_empenios_metal WHERE `t_empenios_metal`.`t_empenios_id` = 2476
        DELETE FROM t_empenios WHERE `t_empenios`.`id` = 11290;
            DELETE FROM t_empenios_metal WHERE `t_empenios_metal`.`t_empenios_id` = 11290
        DELETE FROM t_empenios WHERE `t_empenios`.`id` = 11292;        
            DELETE FROM t_empenios_metal WHERE `t_empenios_metal`.`t_empenios_id` = 11292
        DELETE FROM t_empenios WHERE `t_empenios`.`id` = 16879;        
            DELETE FROM t_empenios_metal WHERE `t_empenios_metal`.`t_empenios_id` = 16879
        DELETE FROM t_empenios WHERE `t_empenios`.`id` = 17519;        
            DELETE FROM t_empenios_metal WHERE `t_empenios_metal`.`t_empenios_id` = 17519
end section;
    
------------------------------------------------- u_operadores 
begin section;
    UPDATE u_operadores SET nombre = UPPER(nombre);
    UPDATE u_operadores SET nombre = TRIM(nombre);
    UPDATE u_operadores SET usuario = TRIM(nombre);
-- marcamos a los operadores que  tienen registros en otras tablas
    UPDATE u_operadores AS u
    SET genero = 100
    WHERE EXISTS (SELECT 1 FROM t_boleta           b WHERE b.u_operador_id   = u.id)
    OR EXISTS (SELECT 1 FROM h_t_boleta            h WHERE h.u_operador_id   = u.id)
    OR EXISTS (SELECT 1 FROM t_boleta_cancelado    c WHERE c.u_operador_id   = u.id)
    OR EXISTS (SELECT 1 FROM t_caja_monto_operador m WHERE m.u_operadores_id = u.id)
    OR EXISTS (SELECT 1 FROM t_suspencion_dias     s WHERE s.u_operadores_id = u.id)
    OR EXISTS (SELECT 1 FROM t_concentrados        t WHERE t.id_operador     = u.id)
    OR EXISTS (SELECT 1 FROM t_descuentos          d WHERE d.id_operador     = u.id)
    OR EXISTS (SELECT 1 FROM r_ro_cg12             p WHERE p.id_operador     = u.id)
    OR EXISTS (SELECT 1 FROM t_reposicion          r WHERE r.id_usuario      = u.id)
-- Se eliminan registros de operadores que no tienen relacion alguna ~37
    DELETE FROM `u_operadores` WHERE genero < 100; 

-- BORRAMOS OPERADOR REPETIDO -- 
    DELETE FROM u_operadores WHERE `u_operadores`.`id` = 1529
    end section

begin u_operadores; 
    UPDATE u_operadores SET id = 151507 WHERE id = 1499;
    UPDATE u_operadores SET id = 151533 WHERE id = 1517;
    UPDATE u_operadores SET id = 151524 WHERE id = 1515;
    UPDATE u_operadores SET id = 151522 WHERE id = 1511;
    UPDATE u_operadores SET id = 151516 WHERE id = 1507;
    UPDATE u_operadores SET id = 151530 WHERE id = 1516;
    UPDATE u_operadores SET id = 151512 WHERE id = 1504;
    UPDATE u_operadores SET id = 151511 WHERE id = 1502;
    UPDATE u_operadores SET id = 151509 WHERE id = 1501;
    UPDATE u_operadores SET id = 151508 WHERE id = 1500;
    UPDATE u_operadores SET id = 151506 WHERE id = 1498;
    UPDATE u_operadores SET id = 151505 WHERE id = 1497;
    UPDATE u_operadores SET id = 151504 WHERE id = 1496;
    UPDATE u_operadores SET id = 151502 WHERE id = 1495;
    UPDATE u_operadores SET id = 151501 WHERE id = 1494;
    UPDATE u_operadores SET id = 151499 WHERE id = 1493;
    UPDATE u_operadores SET id = 151471 WHERE id = 1491;
    UPDATE u_operadores SET id = 151546 WHERE id = 1527;
    UPDATE u_operadores SET id = 151537 WHERE id = 1546;
    UPDATE u_operadores SET id = 151513 WHERE id = 1544;
    UPDATE u_operadores SET id = 151554 WHERE id = 1538;
    UPDATE u_operadores SET id = 151552 WHERE id = 1536;
    UPDATE u_operadores SET id = 151550 WHERE id = 1535;
    UPDATE u_operadores SET id = 151549 WHERE id = 1531;
    UPDATE u_operadores SET id = 151547 WHERE id = 1528;
    UPDATE u_operadores SET id = 151459 WHERE id = 1489;
    UPDATE u_operadores SET id = 151545 WHERE id = 1526;
    UPDATE u_operadores SET id = 151544 WHERE id = 1525;
    UPDATE u_operadores SET id = 151543 WHERE id = 1524;
    UPDATE u_operadores SET id = 151542 WHERE id = 1523;
    UPDATE u_operadores SET id = 151540 WHERE id = 1522;
    UPDATE u_operadores SET id = 151539 WHERE id = 1521;
    UPDATE u_operadores SET id = 151535 WHERE id = 1520;
    UPDATE u_operadores SET id = 151534 WHERE id = 1519;
    UPDATE u_operadores SET id = 151453 WHERE id = 1456;
    UPDATE u_operadores SET id = 151468 WHERE id = 1468;
    UPDATE u_operadores SET id = 151463 WHERE id = 1467;
    UPDATE u_operadores SET id = 150131 WHERE id = 1466;
    UPDATE u_operadores SET id = 151477 WHERE id = 1465;
    UPDATE u_operadores SET id = 151465 WHERE id = 1464;
    UPDATE u_operadores SET id = 151464 WHERE id = 1463;
    UPDATE u_operadores SET id = 151454 WHERE id = 1461;
    UPDATE u_operadores SET id = 151460 WHERE id = 1459;
    UPDATE u_operadores SET id = 151483 WHERE id = 1476;
    UPDATE u_operadores SET id = 150126 WHERE id = 762;
    UPDATE u_operadores SET id = 151476 WHERE id = 1455;
    UPDATE u_operadores SET id = 150117 WHERE id = 756;
    UPDATE u_operadores SET id = 151478 WHERE id = 755;
    UPDATE u_operadores SET id = 150112 WHERE id = 752;
    UPDATE u_operadores SET id = 151486 WHERE id = 1479;
    UPDATE u_operadores SET id = 151493 WHERE id = 1488;
    UPDATE u_operadores SET id = 151490 WHERE id = 1487;
    UPDATE u_operadores SET id = 151458 WHERE id = 1486;
    UPDATE u_operadores SET id = 150118 WHERE id = 1483;
    UPDATE u_operadores SET id = 151489 WHERE id = 1482;
    UPDATE u_operadores SET id = 151488 WHERE id = 1481;
    UPDATE u_operadores SET id = 151487 WHERE id = 1480;
    UPDATE u_operadores SET id = 151485 WHERE id = 1478;
    UPDATE u_operadores SET id = 151466 WHERE id = 1477;
    UPDATE u_operadores SET id = 151482 WHERE id = 1475;
    UPDATE u_operadores SET id = 151481 WHERE id = 1473;
    UPDATE u_operadores SET id = 151475 WHERE id = 1472;
    UPDATE u_operadores SET id = 151473 WHERE id = 1471;
    UPDATE u_operadores SET id = 151461 WHERE id = 1470;
    UPDATE u_operadores SET id = 151474 WHERE id = 1469;

    UPDATE u_operadores SET id = id + 270000 WHERE id = 751;
    UPDATE u_operadores SET id = id + 270000 WHERE id = 1484;
    UPDATE u_operadores SET id = id + 270000 WHERE id = 1453;
    UPDATE u_operadores SET id = id + 270000 WHERE id = 1518;
    UPDATE u_operadores SET id = id + 270000 WHERE id = 1490;
    UPDATE u_operadores SET id = id + 270000 WHERE id = 1534;
    UPDATE u_operadores SET id = id + 270000 WHERE id = 754;
    UPDATE u_operadores SET id = id + 270000 WHERE id = 753;
end u_operadores;

begin t_boletas;

    UPDATE t_boleta  SET    u_operador_id = 151507 WHERE u_operador_id = 1499;
    UPDATE t_boleta  SET    u_operador_id = 151533 WHERE u_operador_id = 1517;
    UPDATE t_boleta  SET    u_operador_id = 151524 WHERE u_operador_id = 1515;
    UPDATE t_boleta  SET    u_operador_id = 151522 WHERE u_operador_id = 1511;
    UPDATE t_boleta  SET    u_operador_id = 151516 WHERE u_operador_id = 1507;
    UPDATE t_boleta  SET    u_operador_id = 151530 WHERE u_operador_id = 1516;
    UPDATE t_boleta  SET    u_operador_id = 151512 WHERE u_operador_id = 1504;
    UPDATE t_boleta  SET    u_operador_id = 151511 WHERE u_operador_id = 1502;
    UPDATE t_boleta  SET    u_operador_id = 151509 WHERE u_operador_id = 1501;
    UPDATE t_boleta  SET    u_operador_id = 151508 WHERE u_operador_id = 1500;
    UPDATE t_boleta  SET    u_operador_id = 151506 WHERE u_operador_id = 1498;
    UPDATE t_boleta  SET    u_operador_id = 151505 WHERE u_operador_id = 1497;
    UPDATE t_boleta  SET    u_operador_id = 151504 WHERE u_operador_id = 1496;
    UPDATE t_boleta  SET    u_operador_id = 151502 WHERE u_operador_id = 1495;
    UPDATE t_boleta  SET    u_operador_id = 151501 WHERE u_operador_id = 1494;
    UPDATE t_boleta  SET    u_operador_id = 151499 WHERE u_operador_id = 1493;
    UPDATE t_boleta  SET    u_operador_id = 151471 WHERE u_operador_id = 1491;
    UPDATE t_boleta  SET    u_operador_id = 151546 WHERE u_operador_id = 1527;
    UPDATE t_boleta  SET    u_operador_id = 151537 WHERE u_operador_id = 1546;
    UPDATE t_boleta  SET    u_operador_id = 151513 WHERE u_operador_id = 1544;
    UPDATE t_boleta  SET    u_operador_id = 151554 WHERE u_operador_id = 1538;
    UPDATE t_boleta  SET    u_operador_id = 151552 WHERE u_operador_id = 1536;
    UPDATE t_boleta  SET    u_operador_id = 151550 WHERE u_operador_id = 1535;
    UPDATE t_boleta  SET    u_operador_id = 151549 WHERE u_operador_id = 1531;
    UPDATE t_boleta  SET    u_operador_id = 151547 WHERE u_operador_id = 1528;
    UPDATE t_boleta  SET    u_operador_id = 151459 WHERE u_operador_id = 1489;
    UPDATE t_boleta  SET    u_operador_id = 151545 WHERE u_operador_id = 1526;
    UPDATE t_boleta  SET    u_operador_id = 151544 WHERE u_operador_id = 1525;
    UPDATE t_boleta  SET    u_operador_id = 151543 WHERE u_operador_id = 1524;
    UPDATE t_boleta  SET    u_operador_id = 151542 WHERE u_operador_id = 1523;
    UPDATE t_boleta  SET    u_operador_id = 151540 WHERE u_operador_id = 1522;
    UPDATE t_boleta  SET    u_operador_id = 151539 WHERE u_operador_id = 1521;
    UPDATE t_boleta  SET    u_operador_id = 151535 WHERE u_operador_id = 1520;
    UPDATE t_boleta  SET    u_operador_id = 151534 WHERE u_operador_id = 1519;
    UPDATE t_boleta  SET    u_operador_id = 151453 WHERE u_operador_id = 1456;
    UPDATE t_boleta  SET    u_operador_id = 151468 WHERE u_operador_id = 1468;
    UPDATE t_boleta  SET    u_operador_id = 151463 WHERE u_operador_id = 1467;
    UPDATE t_boleta  SET    u_operador_id = 150131 WHERE u_operador_id = 1466;
    UPDATE t_boleta  SET    u_operador_id = 151477 WHERE u_operador_id = 1465;
    UPDATE t_boleta  SET    u_operador_id = 151465 WHERE u_operador_id = 1464;
    UPDATE t_boleta  SET    u_operador_id = 151464 WHERE u_operador_id = 1463;
    UPDATE t_boleta  SET    u_operador_id = 151454 WHERE u_operador_id = 1461;
    UPDATE t_boleta  SET    u_operador_id = 151460 WHERE u_operador_id = 1459;
    UPDATE t_boleta  SET    u_operador_id = 151483 WHERE u_operador_id = 1476;
    UPDATE t_boleta  SET    u_operador_id = 150126 WHERE u_operador_id = 762;
    UPDATE t_boleta  SET    u_operador_id = 151476 WHERE u_operador_id = 1455;
    UPDATE t_boleta  SET    u_operador_id = 150117 WHERE u_operador_id = 756;
    UPDATE t_boleta  SET    u_operador_id = 151478 WHERE u_operador_id = 755;
    UPDATE t_boleta  SET    u_operador_id = 150112 WHERE u_operador_id = 752;
    UPDATE t_boleta  SET    u_operador_id = 151486 WHERE u_operador_id = 1479;
    UPDATE t_boleta  SET    u_operador_id = 151493 WHERE u_operador_id = 1488;
    UPDATE t_boleta  SET    u_operador_id = 151490 WHERE u_operador_id = 1487;
    UPDATE t_boleta  SET    u_operador_id = 151458 WHERE u_operador_id = 1486;
    UPDATE t_boleta  SET    u_operador_id = 150118 WHERE u_operador_id = 1483;
    UPDATE t_boleta  SET    u_operador_id = 151489 WHERE u_operador_id = 1482;
    UPDATE t_boleta  SET    u_operador_id = 151488 WHERE u_operador_id = 1481;
    UPDATE t_boleta  SET    u_operador_id = 151487 WHERE u_operador_id = 1480;
    UPDATE t_boleta  SET    u_operador_id = 151485 WHERE u_operador_id = 1478;
    UPDATE t_boleta  SET    u_operador_id = 151466 WHERE u_operador_id = 1477;
    UPDATE t_boleta  SET    u_operador_id = 151482 WHERE u_operador_id = 1475;
    UPDATE t_boleta  SET    u_operador_id = 151481 WHERE u_operador_id = 1473;
    UPDATE t_boleta  SET    u_operador_id = 151475 WHERE u_operador_id = 1472;
    UPDATE t_boleta  SET    u_operador_id = 151473 WHERE u_operador_id = 1471;
    UPDATE t_boleta  SET    u_operador_id = 151461 WHERE u_operador_id = 1470;
    UPDATE t_boleta  SET    u_operador_id = 151474 WHERE u_operador_id = 1469;
    UPDATE t_boleta  SET    u_operador_id = 151484 WHERE u_operador_id = 1462;

    UPDATE t_boleta  SET    u_operador_id = u_operador_id + 270000 WHERE u_operador_id = 1518;
    UPDATE t_boleta  SET    u_operador_id = u_operador_id + 270000 WHERE u_operador_id = 1453;
    UPDATE t_boleta  SET    u_operador_id = u_operador_id + 270000 WHERE u_operador_id = 754;
    UPDATE t_boleta  SET    u_operador_id = u_operador_id + 270000 WHERE u_operador_id = 753;

end t_boletas;

begin h_t_boletas;
    UPDATE h_t_boleta SET u_operador_id = 151507 WHERE u_operador_id = 1499;
    UPDATE h_t_boleta SET u_operador_id = 151533 WHERE u_operador_id = 1517;
    UPDATE h_t_boleta SET u_operador_id = 151522 WHERE u_operador_id = 1511;
    UPDATE h_t_boleta SET u_operador_id = 151516 WHERE u_operador_id = 1507;
    UPDATE h_t_boleta SET u_operador_id = 151530 WHERE u_operador_id = 1516;
    UPDATE h_t_boleta SET u_operador_id = 151512 WHERE u_operador_id = 1504;
    UPDATE h_t_boleta SET u_operador_id = 151511 WHERE u_operador_id = 1502;
    UPDATE h_t_boleta SET u_operador_id = 151509 WHERE u_operador_id = 1501;
    UPDATE h_t_boleta SET u_operador_id = 151508 WHERE u_operador_id = 1500;
    UPDATE h_t_boleta SET u_operador_id = 151506 WHERE u_operador_id = 1498;
    UPDATE h_t_boleta SET u_operador_id = 151505 WHERE u_operador_id = 1497;
    UPDATE h_t_boleta SET u_operador_id = 151504 WHERE u_operador_id = 1496;
    UPDATE h_t_boleta SET u_operador_id = 151502 WHERE u_operador_id = 1495;
    UPDATE h_t_boleta SET u_operador_id = 151501 WHERE u_operador_id = 1494;
    UPDATE h_t_boleta SET u_operador_id = 151499 WHERE u_operador_id = 1493;
    UPDATE h_t_boleta SET u_operador_id = 151471 WHERE u_operador_id = 1491;
    UPDATE h_t_boleta SET u_operador_id = 151546 WHERE u_operador_id = 1527;
    UPDATE h_t_boleta SET u_operador_id = 151537 WHERE u_operador_id = 1546;
    UPDATE h_t_boleta SET u_operador_id = 151513 WHERE u_operador_id = 1544;
    UPDATE h_t_boleta SET u_operador_id = 151554 WHERE u_operador_id = 1538;
    UPDATE h_t_boleta SET u_operador_id = 151552 WHERE u_operador_id = 1536;
    UPDATE h_t_boleta SET u_operador_id = 151550 WHERE u_operador_id = 1535;
    UPDATE h_t_boleta SET u_operador_id = 151547 WHERE u_operador_id = 1528;
    UPDATE h_t_boleta SET u_operador_id = 151459 WHERE u_operador_id = 1489;
    UPDATE h_t_boleta SET u_operador_id = 151545 WHERE u_operador_id = 1526;
    UPDATE h_t_boleta SET u_operador_id = 151544 WHERE u_operador_id = 1525;
    UPDATE h_t_boleta SET u_operador_id = 151543 WHERE u_operador_id = 1524;
    UPDATE h_t_boleta SET u_operador_id = 151542 WHERE u_operador_id = 1523;
    UPDATE h_t_boleta SET u_operador_id = 151540 WHERE u_operador_id = 1522;
    UPDATE h_t_boleta SET u_operador_id = 151539 WHERE u_operador_id = 1521;
    UPDATE h_t_boleta SET u_operador_id = 151535 WHERE u_operador_id = 1520;
    UPDATE h_t_boleta SET u_operador_id = 151534 WHERE u_operador_id = 1519;
    UPDATE h_t_boleta SET u_operador_id = 151453 WHERE u_operador_id = 1456;
    UPDATE h_t_boleta SET u_operador_id = 151468 WHERE u_operador_id = 1468;
    UPDATE h_t_boleta SET u_operador_id = 151463 WHERE u_operador_id = 1467;
    UPDATE h_t_boleta SET u_operador_id = 150131 WHERE u_operador_id = 1466;
    UPDATE h_t_boleta SET u_operador_id = 151477 WHERE u_operador_id = 1465;
    UPDATE h_t_boleta SET u_operador_id = 151465 WHERE u_operador_id = 1464;
    UPDATE h_t_boleta SET u_operador_id = 151464 WHERE u_operador_id = 1463;
    UPDATE h_t_boleta SET u_operador_id = 151454 WHERE u_operador_id = 1461;
    UPDATE h_t_boleta SET u_operador_id = 151460 WHERE u_operador_id = 1459;
    UPDATE h_t_boleta SET u_operador_id = 151483 WHERE u_operador_id = 1476;
    UPDATE h_t_boleta SET u_operador_id = 150126 WHERE u_operador_id = 762;
    UPDATE h_t_boleta SET u_operador_id = 151476 WHERE u_operador_id = 1455;
    UPDATE h_t_boleta SET u_operador_id = 150117 WHERE u_operador_id = 756;
    UPDATE h_t_boleta SET u_operador_id = 151478 WHERE u_operador_id = 755;
    UPDATE h_t_boleta SET u_operador_id = 150112 WHERE u_operador_id = 752;
    UPDATE h_t_boleta SET u_operador_id = 151486 WHERE u_operador_id = 1479;
    UPDATE h_t_boleta SET u_operador_id = 151493 WHERE u_operador_id = 1488;
    UPDATE h_t_boleta SET u_operador_id = 151490 WHERE u_operador_id = 1487;
    UPDATE h_t_boleta SET u_operador_id = 151458 WHERE u_operador_id = 1486;
    UPDATE h_t_boleta SET u_operador_id = 150118 WHERE u_operador_id = 1483;
    UPDATE h_t_boleta SET u_operador_id = 151489 WHERE u_operador_id = 1482;
    UPDATE h_t_boleta SET u_operador_id = 151488 WHERE u_operador_id = 1481;
    UPDATE h_t_boleta SET u_operador_id = 151487 WHERE u_operador_id = 1480;
    UPDATE h_t_boleta SET u_operador_id = 151485 WHERE u_operador_id = 1478;
    UPDATE h_t_boleta SET u_operador_id = 151466 WHERE u_operador_id = 1477;
    UPDATE h_t_boleta SET u_operador_id = 151482 WHERE u_operador_id = 1475;
    UPDATE h_t_boleta SET u_operador_id = 151481 WHERE u_operador_id = 1473;
    UPDATE h_t_boleta SET u_operador_id = 151475 WHERE u_operador_id = 1472;
    UPDATE h_t_boleta SET u_operador_id = 151473 WHERE u_operador_id = 1471;
    UPDATE h_t_boleta SET u_operador_id = 151461 WHERE u_operador_id = 1470;
    UPDATE h_t_boleta SET u_operador_id = 151474 WHERE u_operador_id = 1469;
    UPDATE h_t_boleta SET u_operador_id = 151484 WHERE u_operador_id = 1462;

    UPDATE h_t_boleta  SET    u_operador_id = u_operador_id + 270000 WHERE u_operador_id = 1518;
    UPDATE h_t_boleta  SET    u_operador_id = u_operador_id + 270000 WHERE u_operador_id = 1453;
    UPDATE h_t_boleta  SET    u_operador_id = u_operador_id + 270000 WHERE u_operador_id = 754;
    UPDATE h_t_boleta  SET    u_operador_id = u_operador_id + 270000 WHERE u_operador_id = 753;
    UPDATE h_t_boleta  SET    u_operador_id = u_operador_id + 270000 WHERE u_operador_id = 751;

end h_t_boletas;
    
begin t_boleta_cancelado
    UPDATE t_boleta_cancelado SET u_operador_id = 151507 WHERE u_operador_id = 1499;
    UPDATE t_boleta_cancelado SET u_operador_id = 151533 WHERE u_operador_id = 1517;
    UPDATE t_boleta_cancelado SET u_operador_id = 151524 WHERE u_operador_id = 1515;
    UPDATE t_boleta_cancelado SET u_operador_id = 151522 WHERE u_operador_id = 1511;
    UPDATE t_boleta_cancelado SET u_operador_id = 151516 WHERE u_operador_id = 1507;
    UPDATE t_boleta_cancelado SET u_operador_id = 151530 WHERE u_operador_id = 1516;
    UPDATE t_boleta_cancelado SET u_operador_id = 151512 WHERE u_operador_id = 1504;
    UPDATE t_boleta_cancelado SET u_operador_id = 151511 WHERE u_operador_id = 1502;
    UPDATE t_boleta_cancelado SET u_operador_id = 151509 WHERE u_operador_id = 1501;
    UPDATE t_boleta_cancelado SET u_operador_id = 151508 WHERE u_operador_id = 1500;
    UPDATE t_boleta_cancelado SET u_operador_id = 151506 WHERE u_operador_id = 1498;
    UPDATE t_boleta_cancelado SET u_operador_id = 151505 WHERE u_operador_id = 1497;
    UPDATE t_boleta_cancelado SET u_operador_id = 151504 WHERE u_operador_id = 1496;
    UPDATE t_boleta_cancelado SET u_operador_id = 151502 WHERE u_operador_id = 1495;
    UPDATE t_boleta_cancelado SET u_operador_id = 151501 WHERE u_operador_id = 1494;
    UPDATE t_boleta_cancelado SET u_operador_id = 151499 WHERE u_operador_id = 1493;
    UPDATE t_boleta_cancelado SET u_operador_id = 151471 WHERE u_operador_id = 1491;
    UPDATE t_boleta_cancelado SET u_operador_id = 151546 WHERE u_operador_id = 1527;
    UPDATE t_boleta_cancelado SET u_operador_id = 151537 WHERE u_operador_id = 1546;
    UPDATE t_boleta_cancelado SET u_operador_id = 151513 WHERE u_operador_id = 1544;
    UPDATE t_boleta_cancelado SET u_operador_id = 151554 WHERE u_operador_id = 1538;
    UPDATE t_boleta_cancelado SET u_operador_id = 151552 WHERE u_operador_id = 1536;
    UPDATE t_boleta_cancelado SET u_operador_id = 151550 WHERE u_operador_id = 1535;
    UPDATE t_boleta_cancelado SET u_operador_id = 151549 WHERE u_operador_id = 1531;
    UPDATE t_boleta_cancelado SET u_operador_id = 151547 WHERE u_operador_id = 1528;
    UPDATE t_boleta_cancelado SET u_operador_id = 151459 WHERE u_operador_id = 1489;
    UPDATE t_boleta_cancelado SET u_operador_id = 151545 WHERE u_operador_id = 1526;
    UPDATE t_boleta_cancelado SET u_operador_id = 151544 WHERE u_operador_id = 1525;
    UPDATE t_boleta_cancelado SET u_operador_id = 151543 WHERE u_operador_id = 1524;
    UPDATE t_boleta_cancelado SET u_operador_id = 151542 WHERE u_operador_id = 1523;
    UPDATE t_boleta_cancelado SET u_operador_id = 151540 WHERE u_operador_id = 1522;
    UPDATE t_boleta_cancelado SET u_operador_id = 151539 WHERE u_operador_id = 1521;
    UPDATE t_boleta_cancelado SET u_operador_id = 151535 WHERE u_operador_id = 1520;
    UPDATE t_boleta_cancelado SET u_operador_id = 151534 WHERE u_operador_id = 1519;
    UPDATE t_boleta_cancelado SET u_operador_id = 151453 WHERE u_operador_id = 1456;
    UPDATE t_boleta_cancelado SET u_operador_id = 151468 WHERE u_operador_id = 1468;
    UPDATE t_boleta_cancelado SET u_operador_id = 151463 WHERE u_operador_id = 1467;
    UPDATE t_boleta_cancelado SET u_operador_id = 150131 WHERE u_operador_id = 1466;
    UPDATE t_boleta_cancelado SET u_operador_id = 151477 WHERE u_operador_id = 1465;
    UPDATE t_boleta_cancelado SET u_operador_id = 151465 WHERE u_operador_id = 1464;
    UPDATE t_boleta_cancelado SET u_operador_id = 151464 WHERE u_operador_id = 1463;
    UPDATE t_boleta_cancelado SET u_operador_id = 151454 WHERE u_operador_id = 1461 OR u_operador_id = 1454;
    UPDATE t_boleta_cancelado SET u_operador_id = 151460 WHERE u_operador_id = 1459;
    UPDATE t_boleta_cancelado SET u_operador_id = 151483 WHERE u_operador_id = 1476;
    UPDATE t_boleta_cancelado SET u_operador_id = 150126 WHERE u_operador_id = 762;
    UPDATE t_boleta_cancelado SET u_operador_id = 151476 WHERE u_operador_id = 1455;
    UPDATE t_boleta_cancelado SET u_operador_id = 150117 WHERE u_operador_id = 756;
    UPDATE t_boleta_cancelado SET u_operador_id = 151478 WHERE u_operador_id = 755;
    UPDATE t_boleta_cancelado SET u_operador_id = 150112 WHERE u_operador_id = 752;
    UPDATE t_boleta_cancelado SET u_operador_id = 151486 WHERE u_operador_id = 1479;
    UPDATE t_boleta_cancelado SET u_operador_id = 151493 WHERE u_operador_id = 1488;
    UPDATE t_boleta_cancelado SET u_operador_id = 151490 WHERE u_operador_id = 1487;
    UPDATE t_boleta_cancelado SET u_operador_id = 151458 WHERE u_operador_id = 1486;
    UPDATE t_boleta_cancelado SET u_operador_id = 150118 WHERE u_operador_id = 1483;
    UPDATE t_boleta_cancelado SET u_operador_id = 151489 WHERE u_operador_id = 1482;
    UPDATE t_boleta_cancelado SET u_operador_id = 151488 WHERE u_operador_id = 1481;
    UPDATE t_boleta_cancelado SET u_operador_id = 151487 WHERE u_operador_id = 1480;
    UPDATE t_boleta_cancelado SET u_operador_id = 151485 WHERE u_operador_id = 1478;
    UPDATE t_boleta_cancelado SET u_operador_id = 151466 WHERE u_operador_id = 1477;
    UPDATE t_boleta_cancelado SET u_operador_id = 151482 WHERE u_operador_id = 1475;
    UPDATE t_boleta_cancelado SET u_operador_id = 151481 WHERE u_operador_id = 1473;
    UPDATE t_boleta_cancelado SET u_operador_id = 151475 WHERE u_operador_id = 1472;
    UPDATE t_boleta_cancelado SET u_operador_id = 151473 WHERE u_operador_id = 1471;
    UPDATE t_boleta_cancelado SET u_operador_id = 151461 WHERE u_operador_id = 1470;
    UPDATE t_boleta_cancelado SET u_operador_id = 151474 WHERE u_operador_id = 1469;
    UPDATE t_boleta_cancelado SET u_operador_id = 151484 WHERE u_operador_id = 1462;
    UPDATE `t_boleta_cancelado` SET `u_operador_id` = '150126' WHERE `t_boleta_cancelado`.`id_interno` = 134; 
end t_boleta_cancelado;

begin t_caja_monto_operador

    UPDATE t_caja_monto_operador SET u_operadores_id = 151507 WHERE u_operadores_id = 1499;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151533 WHERE u_operadores_id = 1517;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151524 WHERE u_operadores_id = 1515;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151522 WHERE u_operadores_id = 1511;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151516 WHERE u_operadores_id = 1507;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151530 WHERE u_operadores_id = 1516;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151512 WHERE u_operadores_id = 1504;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151511 WHERE u_operadores_id = 1502;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151509 WHERE u_operadores_id = 1501;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151508 WHERE u_operadores_id = 1500;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151506 WHERE u_operadores_id = 1498;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151505 WHERE u_operadores_id = 1497;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151504 WHERE u_operadores_id = 1496;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151502 WHERE u_operadores_id = 1495;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151501 WHERE u_operadores_id = 1494;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151499 WHERE u_operadores_id = 1493;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151471 WHERE u_operadores_id = 1491;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151546 WHERE u_operadores_id = 1527;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151537 WHERE u_operadores_id = 1546;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151513 WHERE u_operadores_id = 1544;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151554 WHERE u_operadores_id = 1538;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151552 WHERE u_operadores_id = 1536;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151550 WHERE u_operadores_id = 1535;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151547 WHERE u_operadores_id = 1528;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151459 WHERE u_operadores_id = 1489;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151545 WHERE u_operadores_id = 1526;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151544 WHERE u_operadores_id = 1525;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151543 WHERE u_operadores_id = 1524;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151542 WHERE u_operadores_id = 1523;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151540 WHERE u_operadores_id = 1522;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151539 WHERE u_operadores_id = 1521;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151535 WHERE u_operadores_id = 1520;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151534 WHERE u_operadores_id = 1519;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151453 WHERE u_operadores_id = 1456;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151468 WHERE u_operadores_id = 1468;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151463 WHERE u_operadores_id = 1467;
    UPDATE t_caja_monto_operador SET u_operadores_id = 150131 WHERE u_operadores_id = 1466;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151477 WHERE u_operadores_id = 1465;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151465 WHERE u_operadores_id = 1464;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151464 WHERE u_operadores_id = 1463;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151454 WHERE u_operadores_id = 1461;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151460 WHERE u_operadores_id = 1459;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151483 WHERE u_operadores_id = 1476;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151476 WHERE u_operadores_id = 1455;
    UPDATE t_caja_monto_operador SET u_operadores_id = 150117 WHERE u_operadores_id = 756;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151478 WHERE u_operadores_id = 755;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151486 WHERE u_operadores_id = 1479;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151493 WHERE u_operadores_id = 1488;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151490 WHERE u_operadores_id = 1487;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151458 WHERE u_operadores_id = 1486;
    UPDATE t_caja_monto_operador SET u_operadores_id = 150118 WHERE u_operadores_id = 1483;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151489 WHERE u_operadores_id = 1482;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151488 WHERE u_operadores_id = 1481;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151487 WHERE u_operadores_id = 1480;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151485 WHERE u_operadores_id = 1478;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151466 WHERE u_operadores_id = 1477;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151482 WHERE u_operadores_id = 1475;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151481 WHERE u_operadores_id = 1473;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151475 WHERE u_operadores_id = 1472;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151473 WHERE u_operadores_id = 1471;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151461 WHERE u_operadores_id = 1470;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151474 WHERE u_operadores_id = 1469;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151484 WHERE u_operadores_id = 1462;

    UPDATE t_caja_monto_operador  SET    u_operadores_id = u_operadores_id + 270000 WHERE u_operadores_id = 1518;
    UPDATE t_caja_monto_operador  SET    u_operadores_id = u_operadores_id + 270000 WHERE u_operadores_id = 1453;
    UPDATE t_caja_monto_operador  SET    u_operadores_id = u_operadores_id + 270000 WHERE u_operadores_id = 753;
    UPDATE t_caja_monto_operador  SET    u_operadores_id = u_operadores_id + 270000 WHERE u_operadores_id = 751;
end t_caja_monto_operador;

begin t_concentrados
    UPDATE t_concentrados  SET    id_operador = 151512 WHERE id_operador = 1504;
    UPDATE t_concentrados  SET    id_operador = 151554 WHERE id_operador = 1538;
    UPDATE t_concentrados  SET    id_operador = 151534 WHERE id_operador = 1519;
    UPDATE t_concentrados  SET    id_operador = 151453 WHERE id_operador = 1456;
    UPDATE t_concentrados  SET    id_operador = 150131 WHERE id_operador = 1466;
    UPDATE t_concentrados  SET    id_operador = 151477 WHERE id_operador = 1465;
    UPDATE t_concentrados  SET    id_operador = 151465 WHERE id_operador = 1464;
    UPDATE t_concentrados  SET    id_operador = 151464 WHERE id_operador = 1463;
    UPDATE t_concentrados  SET    id_operador = 151454 WHERE id_operador = 1461;
    UPDATE t_concentrados  SET    id_operador = 151460 WHERE id_operador = 1459;
    UPDATE t_concentrados  SET    id_operador = 151476 WHERE id_operador = 1455;
    UPDATE t_concentrados  SET    id_operador = 150117 WHERE id_operador = 756;
    UPDATE t_concentrados  SET    id_operador = 151478 WHERE id_operador = 755;
    UPDATE t_concentrados  SET    id_operador = 151490 WHERE id_operador = 1487;
    UPDATE t_concentrados  SET    id_operador = 151488 WHERE id_operador = 1481;
    UPDATE t_concentrados  SET    id_operador = 151487 WHERE id_operador = 1480;
    UPDATE t_concentrados  SET    id_operador = 151485 WHERE id_operador = 1478;
    UPDATE t_concentrados  SET    id_operador = 151473 WHERE id_operador = 1471;
    UPDATE t_concentrados  SET    id_operador = 151461 WHERE id_operador = 1470;
    UPDATE t_concentrados  SET    id_operador = 151484 WHERE id_operador = 1462;

    UPDATE t_concentrados  SET    id_operador = id_operador + 270000 WHERE id_operador = 1518;
    UPDATE t_concentrados  SET    id_operador = id_operador + 270000 WHERE id_operador = 753;
    UPDATE t_concentrados  SET    id_operador = id_operador + 270000 WHERE id_operador = 751;

end t_concentrados;

begin r_ro_cg12
    UPDATE r_ro_cg12    SET    id_operador = 151507 WHERE id_operador = 1499   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151533 WHERE id_operador = 1517   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151522 WHERE id_operador = 1511   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151516 WHERE id_operador = 1507   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151530 WHERE id_operador = 1516   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151512 WHERE id_operador = 1504   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151511 WHERE id_operador = 1502   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151509 WHERE id_operador = 1501   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151508 WHERE id_operador = 1500   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151506 WHERE id_operador = 1498   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151505 WHERE id_operador = 1497   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151504 WHERE id_operador = 1496   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151502 WHERE id_operador = 1495   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151501 WHERE id_operador = 1494   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151499 WHERE id_operador = 1493   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151471 WHERE id_operador = 1491   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151546 WHERE id_operador = 1527   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151537 WHERE id_operador = 1546   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151513 WHERE id_operador = 1544   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151554 WHERE id_operador = 1538   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151552 WHERE id_operador = 1536   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151550 WHERE id_operador = 1535   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151549 WHERE id_operador = 1531   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151547 WHERE id_operador = 1528   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151459 WHERE id_operador = 1489   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151545 WHERE id_operador = 1526   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151544 WHERE id_operador = 1525   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151543 WHERE id_operador = 1524   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151542 WHERE id_operador = 1523   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151540 WHERE id_operador = 1522   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151539 WHERE id_operador = 1521   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151535 WHERE id_operador = 1520   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151534 WHERE id_operador = 1519   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151453 WHERE id_operador = 1456   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151468 WHERE id_operador = 1468   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151463 WHERE id_operador = 1467   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 150131 WHERE id_operador = 1466   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151477 WHERE id_operador = 1465   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151465 WHERE id_operador = 1464   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151464 WHERE id_operador = 1463   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151454 WHERE id_operador = 1461   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151460 WHERE id_operador = 1459   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151483 WHERE id_operador = 1476   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151476 WHERE id_operador = 1455   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 150117 WHERE id_operador = 756AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151478 WHERE id_operador = 755AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151486 WHERE id_operador = 1479   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151493 WHERE id_operador = 1488   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151490 WHERE id_operador = 1487   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151458 WHERE id_operador = 1486   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 150118 WHERE id_operador = 1483   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151489 WHERE id_operador = 1482   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151488 WHERE id_operador = 1481   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151487 WHERE id_operador = 1480   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151485 WHERE id_operador = 1478   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151466 WHERE id_operador = 1477   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151482 WHERE id_operador = 1475   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151481 WHERE id_operador = 1473   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151475 WHERE id_operador = 1472   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151473 WHERE id_operador = 1471   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151461 WHERE id_operador = 1470   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151474 WHERE id_operador = 1469   AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = 151484 WHERE id_operador = 1462   AND sucursal_id = 27;

    UPDATE r_ro_cg12    SET    id_operador = id_operador + 270000 WHERE id_operador = 1518 AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = id_operador + 270000 WHERE id_operador = 1534 AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = id_operador + 270000 WHERE id_operador = 1453 AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = id_operador + 270000 WHERE id_operador = 753  AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = id_operador + 270000 WHERE id_operador = 1484 AND sucursal_id = 27;
    UPDATE r_ro_cg12    SET    id_operador = id_operador + 270000 WHERE id_operador = 751  AND sucursal_id = 27;

    UPDATE `r_ro_cg12` SET `id_operador` = '151454' WHERE id_operador = 28 and sucursal_id = 12;      --Abastos
    UPDATE `r_ro_cg12` SET `id_operador` = '151460' WHERE id_operador = 80 and sucursal_id = 12; 
    UPDATE `r_ro_cg12` SET `id_operador` = '151508' WHERE id_operador = 83 and sucursal_id = 12; 
    UPDATE `r_ro_cg12` SET `id_operador` = '151454' WHERE id_operador = 65 and sucursal_id = 13;      --Xoxo
    UPDATE `r_ro_cg12` SET `id_operador` = '151476' WHERE id_operador = 106 and sucursal_id = 13; 
    UPDATE `r_ro_cg12` SET `id_operador` = '151454' WHERE id_operador = 141 and sucursal_id = 14;     --Modulo Azul
    UPDATE `r_ro_cg12` SET `id_operador` = '151454' WHERE id_operador = 1454 and sucursal_id = 15; 
    UPDATE `r_ro_cg12` SET `id_operador` = '151490' WHERE id_operador = 1490 and sucursal_id = 15; 
    UPDATE `r_ro_cg12` SET `id_operador` = '151484' WHERE id_operador = 1490 and sucursal_id = 27; 

end r_ro_cg12;

begin t_reposicion
    UPDATE t_reposicion  SET    id_usuario = 151512 WHERE id_usuario = 1504;
    UPDATE t_reposicion  SET    id_usuario = 151534 WHERE id_usuario = 1519;
    UPDATE t_reposicion  SET    id_usuario = 151453 WHERE id_usuario = 1456;
    UPDATE t_reposicion  SET    id_usuario = 151477 WHERE id_usuario = 1465;
    UPDATE t_reposicion  SET    id_usuario = 151464 WHERE id_usuario = 1463;
    UPDATE t_reposicion  SET    id_usuario = 151454 WHERE id_usuario = 1461;
    UPDATE t_reposicion  SET    id_usuario = 151460 WHERE id_usuario = 1459;
    UPDATE t_reposicion  SET    id_usuario = 151476 WHERE id_usuario = 1455;
    UPDATE t_reposicion  SET    id_usuario = 150117 WHERE id_usuario = 756;
    UPDATE t_reposicion  SET    id_usuario = 151478 WHERE id_usuario = 755;
    UPDATE t_reposicion  SET    id_usuario = 151490 WHERE id_usuario = 1487;
    UPDATE t_reposicion  SET    id_usuario = 151487 WHERE id_usuario = 1480;
    UPDATE t_reposicion  SET    id_usuario = 151473 WHERE id_usuario = 1471;
    UPDATE t_reposicion  SET    id_usuario = 151484 WHERE id_usuario = 1462;

    UPDATE t_reposicion  SET    id_usuario = id_usuario  + 270000 WHERE id_usuario = 1453;
    UPDATE t_reposicion  SET    id_usuario = id_usuario  + 270000 WHERE id_usuario = 753;
end t_reposicion;

UPDATE t_suspencion_dias SET u_operadores_id = 150126 WHERE u_operadores_id = 762 OR u_operadores_id = 126 OR u_operadores_id = 862;
UPDATE t_descuentos  SET    id_operador = 151476 WHERE id_operador = 1455;









-- Comprobamos que el operador no tenga registros en otras tablas, antes de eliminarlo
    SELECT * FROM u_operadores          WHERE id              = 1529;
    SELECT * FROM t_boleta              WHERE u_operador_id   = 1529;
    SELECT * FROM h_t_boleta            WHERE u_operador_id   = 1529;
    SELECT * FROM t_boleta_cancelado    WHERE u_operador_id   = 1529;
    SELECT * FROM t_caja_monto_operador WHERE u_operadores_id = 1529;
    SELECT * FROM t_suspencion_dias     WHERE u_operadores_id = 1529;
    SELECT * FROM t_concentrados        WHERE id_operador     = 1529;
    SELECT * FROM t_descuentos          WHERE id_operador     = 1529;
    SELECT * FROM r_ro_cg12             WHERE id_operador     = 1529;
    SELECT * FROM t_reposicion          WHERE id_usuario      = 1529;


-------------------------------------------------> t_empenios 
-- ❌ borramos los empeños que no tienen relacion t_empenios_boleta_relacion (~0 registros)
    SELECT t_empenios.*        FROM    t_empenios        LEFT JOIN t_empenios_boleta_relacion ON t_empenios_boleta_relacion.t_empenios_id= t_empenios.id        WHERE t_empenios_boleta_relacion.id IS NULL;
    DELETE t_empenios FROM t_empenios         LEFT JOIN t_empenios_boleta_relacion ON t_empenios_boleta_relacion.t_empenios_id= t_empenios.id        WHERE t_empenios_boleta_relacion.id IS NULL;

------------------------------------------------- u_pignotarios 
    UPDATE u_pignotarios SET nombre = TRIM(nombre);
    SELECT * FROM `u_pignotarios` WHERE nombre LIKE "%‘%";
    UPDATE u_pignotarios SET nombre = REPLACE(nombre, 'Ñ‘', 'Ñ')
    UPDATE u_pignotarios SET nombre = REPLACE(nombre, 'ÃƒÂ‘', 'Ñ')
    UPDATE u_pignotarios SET nombre = REPLACE(nombre, 'Ã‘', 'Ñ'),

    Ã‚Âƒ        --> id 609 	
    UPDATE `u_pignotarios` SET `nombre` = 'MARTINEZ IBAÑEZ DELIA' WHERE `u_pignotarios`.`id` = 609 AND `u_pignotarios`.`ife` = 'MRIBDL86101620H000'; 



------------------------------------------------- pignorante_solidario
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = UPPER(pignorante_solidario);
    SELECT * FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '%‘%';
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, '*', '')
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, '   ', '  ')
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'Âƒ', 'ª')
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'Ãƒ', 'ª')
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'Â‚', 'ª')
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'Ã‚', 'ª')
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'Â‘', 'ª')
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'Ã‘', 'ª')
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'ªª', 'ª')  
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'ª', 'Ñ');

    UPDATE u_pignotarios_solidarios SET pignorante_solidario = TRIM(pignorante_solidario);

    SELECT pignorante_solidario, COUNT(t_boleta_id) FROM u_pignotarios_solidarios WHERE LENGTH(pignorante_solidario) < 9 GROUP BY pignorante_solidario; 
        SELECT pignorante_solidario, COUNT(t_boleta_id) FROM u_pignotarios_solidarios WHERE LENGTH(pignorante_solidario) < 14 GROUP BY pignorante_solidario
        DELETE FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '% DEJA%' AND LENGTH(pignorante_solidario) < 18;
    DELETE FROM u_pignotarios_solidarios WHERE LENGTH(pignorante_solidario) < 9 ;
    UPDATE `u_pignotarios_solidarios` SET `pignorante_solidario` = 'CARMEN ORTIZ CALZADILLA' WHERE `u_pignotarios_solidarios`.`id` = 9885; 
    UPDATE `u_pignotarios_solidarios` SET `pignorante_solidario` = '9513160844 C DICICION DE ORIENTE 404 BARR EX MARQUEZADO' WHERE `u_pignotarios_solidarios`.`id` = 4431; 
    UPDATE `u_pignotarios_solidarios` SET `pignorante_solidario` = '9513160844 C DICICION DE ORIENTE 404 BARR EX MARQUEZADO' WHERE `u_pignotarios_solidarios`.`id` = 4432; 
    UPDATE `u_pignotarios_solidarios` SET `pignorante_solidario` = 'C DICICION DE ORIENTE 404 BARR EX MARQUEZADO' WHERE `u_pignotarios_solidarios`.`id` = 3008; 
    UPDATE `u_pignotarios_solidarios` SET `pignorante_solidario` = 'C DICICION DE ORIENTE 404 BARR EX MARQUEZADO' WHERE `u_pignotarios_solidarios`.`id` = 3052; 
    UPDATE `u_pignotarios_solidarios` SET `pignorante_solidario` = 'C DICICION DE ORIENTE 404 BARR EX MARQUEZADO' WHERE `u_pignotarios_solidarios`.`id` = 3104; 
    UPDATE `u_pignotarios_solidarios` SET `pignorante_solidario` = 'C DICICION DE ORIENTE 404 BARR EX MARQUEZADO' WHERE `u_pignotarios_solidarios`.`id` = 4316; 
    UPDATE `u_pignotarios_solidarios` SET `pignorante_solidario` = 'C LOMA BONITA 207 COL SIETE REGIONES' WHERE `u_pignotarios_solidarios`.`id` = 2421; 
    UPDATE `u_pignotarios_solidarios` SET `pignorante_solidario` = 'C LOMA BONITA 207 COL SIETE REGIONES' WHERE `u_pignotarios_solidarios`.`id` = 5750; 
------------------------------------------------- t_boletas
-- Se corrige fechas en 0000-00-00
    UPDATE `t_boleta` SET `fecha_limite_pago` = '2021-03-02' WHERE `t_boleta`.`id` = 10009023; 

------------------------------------------------- h_t_boletas
-- Se corrige fechas en 0000-00-00
    UPDATE `h_t_boleta` SET `fecha_limite_pago` = '2021-03-02' WHERE `h_t_boleta`.`id_interno` = 73663; 
    UPDATE `h_t_boleta` SET `fecha_limite_pago` = '2021-02-27' WHERE `h_t_boleta`.`id_interno` = 42517; 



--                   t_comprador   y   t_compra_vitrina    
            UPDATE `t_comprador` SET `rfc` = null WHERE rfc = 'xxx';
            UPDATE `t_comprador` SET `rfc` = null WHERE rfc = ''; 

            UPDATE `t_comprador` SET `ife` = null WHERE ife = 'xxx'; 
            UPDATE `t_comprador` SET `ife` = null WHERE ife = ''; 

            UPDATE `t_comprador` SET `curp` = null WHERE curp = 'xxx'; 
            UPDATE `t_comprador` SET `curp` = null WHERE curp = ''; 

            UPDATE `t_comprador` SET `rfc` = NULL, ife = NULL, curp = NULL WHERE `t_comprador`.`id` = 123; 
            UPDATE `t_comprador` SET `rfc` = NULL, ife = NULL, curp = NULL WHERE `t_comprador`.`id` = 124; 

            
            UPDATE t_compra_vitrina SET t_comprador_id = 265 WHERE t_comprador_id = 266;            -- id repetido = 265(se conserva) <--- 266(eliminamos)            
            DELETE FROM t_comprador WHERE `t_comprador`.`id` = 266,

            UPDATE t_compra_vitrina SET t_comprador_id = 320 WHERE t_comprador_id = 325;            -- id repetido = conservamos:[320] <--- eliminamos:[325,357]
            UPDATE t_compra_vitrina SET t_comprador_id = 320 WHERE t_comprador_id = 357;            -- id repetido = conservamos:[320] <--- eliminamos:[325,357]
            DELETE FROM t_comprador WHERE `t_comprador`.`id` = 325,
            DELETE FROM t_comprador WHERE `t_comprador`.`id` = 357;



    
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



end section;