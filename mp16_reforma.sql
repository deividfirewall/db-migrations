$ gunzip -c mp_reforma_250430.sql.gz | ./vendor/bin/sail exec -T mysql mysql -u root mp_reforma
$ rm mp_reforma_250430.sql.gz 

DROP TABLE  `c_cotiza_producto_08112015`, `c_printer_operador_tipo`, `c_procesos_juridicos`, `c_sub_productos_08112015`, 
            `c_sub_productos_2014_12_12`, `c_tipo_prestamo_12042015`, `h_rp_subasta`, `h_t_boleta_26_marzo_2015`, 
            `migration_boletas`, `migrations`, `password_resets`, `r_rg_cg11+1Abril2015`, `r_rg_cg11_13_abril_2015`, 
            `rg_dda07`, `rg_ddd04`, `rg_de02`, `rg_dra06`, `rg_drd03`, `rg_rod13+1Abril2015`, `t_boleta_migracion`, 
            `t_boetas_pagos_mal_NoVenta`, `t_boleta_pagos_19022015`, `t_boleta_pagos_old_19022015`, `t_concentrados`, 
            `t_empenios_2014_12_12`, `t_empenios_metal`, `t_empenios_metal_2014_12_12`, `t_empenios_productos_2014_12_12`,
            `t_migration_missing`, `t_subasta_copy`, `users`, `u_directores`, `c_sucursal_12042015`, `c_sucursal_v1`, 
            `c_tipo_printer`, `h_t_boleta_copy`, `t_boleta_copy`, `c_fecha_reporte`, `c_intereses`, `c_printer_operador`, 
            `c_nivel`, `c_status_usuario`;

begin section;
------------------------------------------------- u_pignotarios 
    UPDATE u_pignotarios SET nombre = TRIM(nombre);
    SELECT * FROM `u_pignotarios` WHERE nombre LIKE "%‘%";
    UPDATE u_pignotarios SET nombre = REPLACE(nombre, 'ÃƒÂ‘', 'Ñ');
    UPDATE u_pignotarios SET direccion  = REPLACE(direccion , 'Ã‘', 'Ñ');

------------------------------------------------- pignorante_solidario
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = UPPER(pignorante_solidario); 
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = TRIM(pignorante_solidario);

    SELECT * FROM u_pignotarios_solidarios WHERE pignorante_solidario LIKE '%‘%';

    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, '*', '')    
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, ',', ''); 
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, '  ', ' ')
        Ü ===   [264]:ARGªÂœELLES, [478]:SIGªÂENZA,    --VERIFICAR ANTES DE HACER EL UPDATE
        í ===   [1333,1337,1473,1546]: MARTªÂNEZ
        Ó ===   [2809]: CONCEPCIÃ“N
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'Âƒ', 'ª')
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'Ãƒ', 'ª')
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'Â‚', 'ª')
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'Ã‚', 'ª')
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'Â‘', 'ª')
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'Ã‘', 'ª')
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'ªª', 'ª')  --x8
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'ªÂœ', 'Ü')
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'ªÂ', 'Í')
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'Ã“', 'Ó')
    
    UPDATE u_pignotarios_solidarios SET pignorante_solidario = REPLACE(pignorante_solidario, 'ª', 'Ñ');

    SELECT pignorante_solidario, COUNT(t_boleta_id) FROM u_pignotarios_solidarios WHERE LENGTH(pignorante_solidario) < 15 GROUP BY pignorante_solidario; 
    DELETE FROM u_pignotarios_solidarios WHERE LENGTH(pignorante_solidario) < 15;

end section;