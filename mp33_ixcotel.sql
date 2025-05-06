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



INSERT INTO `users` VALUES 
(33036,'33036','ABIMAEL ABRAHAM CARREÑO FLORES','33036@operador_rf160','operador_rf160','1',0,0,33,'siemp_ixcotel','neutral-300',NULL,'827ccb0eea8a706c4c34a16891f84e7b',NULL,NULL,NULL,'2025-01-20 00:00:00',NULL),

(07,'--> 151453','NARCISO ARTURO GARCIA GUZMAN','33007@operador_ixc1','operador_ixc1','1',0,0,33,'siemp_ixcotel','neutral-300',NULL,'df12ecd077efc8c23881028604dbb8cc','2100-12-31',NULL,NULL,'2024-05-01 00:00:00',NULL),
(08,'--> 151537','ISAAC JARED LOPEZ JARQUIN','33008@operador_ixc2','operador_ixc2','1',0,0,33,'siemp_ixcotel','neutral-300',NULL,'7e7e69ea3384874304911625ac34321c','2100-12-31',NULL,NULL,'2024-05-01 00:00:00',NULL),
(12,'--> 151539','ADRIANA VANESSA FRANCO VASQUEZ','33012@operador_ixc3','operador_ixc3','0',0,0,33,'siemp_ixcotel','neutral-300',NULL,'202cb962ac59075b964b07152d234b70','2100-12-31',NULL,NULL,'2024-05-01 00:00:00',NULL),
(13,'--> 151530','CESAR JOEL NAVARRO ESPINOSA DE LOS MONTERO','33013@operador_ixc4','operador_ixc4','1',0,0,33,'siemp_ixcotel','neutral-300',NULL,'138163901f4859c9601f08cfa428efe1','2100-12-31',NULL,NULL,'2024-06-01 00:00:00',NULL),
(17,'--> 151540','ALVARO LEON MARQUEZ','33017@operador_ixc5','operador_ixc5','1',0,0,33,'siemp_ixcotel','neutral-300',NULL,'202cb962ac59075b964b07152d234b70','2100-12-31',NULL,NULL,'2024-08-15 00:00:00',NULL),
(18,'--> 151482','LORENA GUADALUPE LEON SILVA ','33018@operador_ixc6','operador_ixc6','0',0,0,33,'siemp_ixcotel','neutral-300',NULL,'65d4a95daf99c88e06392b6e59b1d2eb','2100-12-31',NULL,NULL,'2024-08-15 00:00:00',NULL),
(11,'--> 151529','LUIS MIGUEL GALEOTE ROSARIO','33011@operador_valles1','operador_valles1','1',0,0,33,'siemp_ixcotel','neutral-300',NULL,'6caec386163d2a0e823ff73cbd564f0b','2100-12-31',NULL,NULL,'2024-05-01 00:00:00',NULL),
(15,'--> 151490','TOMAS LOPEZ ALEJANDRA','33015@operador_rf128','operador_rf128','1',0,0,33,'siemp_ixcotel','neutral-300',NULL,'caf1a3dfb505ffed0d024130f58c5cfa','2100-12-31',NULL,NULL,'2024-07-16 00:00:00',NULL),
(16,'--> 151473','ESTRELLA MARISOL MORALES','33016@operador_rf103','operador_rf103','1',0,0,33,'siemp_ixcotel','neutral-300',NULL,'0bb6f7783b68d95cd24d1c4b3db2748e','2100-12-31',NULL,NULL,'2024-08-15 00:00:00',NULL),
(20,'--> 151507','MARTHA BURGUETE BRENA','33020@operador_rf142','operador_rf142','0',0,0,33,'siemp_ixcotel','neutral-300',NULL,'25df35de87aa441b88f22a6c2a830a17',NULL,NULL,NULL,'2024-08-16 00:00:00',NULL),
(21,'--> 151459','TERESA DE JESUS LOPEZ SANCHEZ','33021@operador_rf130','operador_rf130','0',0,0,33,'siemp_ixcotel','neutral-300',NULL,'94a73d553fefca62826b87b8d1601485',NULL,NULL,NULL,'2024-08-16 00:00:00',NULL),
(22,'--> 150118','OMAR RAMIREZ PACHECO','33022@operador_rf126','operador_rf126','1',0,0,33,'siemp_ixcotel','neutral-300',NULL,'3836794ac51bd01fe50e4faa48ca6e0e',NULL,NULL,NULL,'2024-08-16 00:00:00',NULL),
(23,'--> 151545','LILIANA PATRICIA MORALES GARCIA','33023@operador_rf155','operador_rf155','0',0,0,33,'siemp_ixcotel','neutral-300',NULL,'827ccb0eea8a706c4c34a16891f84e7b',NULL,NULL,NULL,'2024-09-02 00:00:00',NULL),
(26,'--> 151547','RUBI CRISTAL HERNANDEZ TRUJILLO','33026@operador_valles12','operador_valles12','0',0,0,33,'siemp_ixcotel','neutral-300',NULL,'a0872cc5b5ca4cc25076f3d868e1bdf8',NULL,NULL,NULL,'2024-10-01 00:00:00',NULL),
(27,'--> 151461','ISABEL RAMIREZ ROMERO','33027@operador_rf101','operador_rf101','0',0,0,33,'siemp_ixcotel','neutral-300',NULL,'827ccb0eea8a706c4c34a16891f84e7b',NULL,NULL,NULL,'2024-10-01 00:00:00',NULL),
(28,'--> 151487','JOEL EDUARDO BENITEZ VELASCO','33028@operador_rf123','operador_rf123','1',0,0,33,'siemp_ixcotel','neutral-300',NULL,'827ccb0eea8a706c4c34a16891f84e7b',NULL,NULL,NULL,'2024-10-01 00:00:00',NULL),
(31,'--> 151550','EDGAR HORLANDO SOSA IRIARTE','33031@operador_rf156','operador_rf156','1',0,0,33,'siemp_ixcotel','neutral-300',NULL,'827ccb0eea8a706c4c34a16891f84e7b',NULL,NULL,NULL,'2024-12-05 00:00:00',NULL),
(32,'--> 150131','MIREYA NASHIELLY HERNANDEZ GUZMAN','33032@operador_rf114','operador_rf114','1',0,0,33,'siemp_ixcotel','neutral-300',NULL,'64605d08ca5cdfe1666fb3898c6aac40',NULL,NULL,NULL,'2024-12-05 00:00:00',NULL),
(33,'--> 151511','BEATRIZ VELAZQUEZ CORTES','33033@operador_rf145','operador_rf145','0',0,0,33,'siemp_ixcotel','neutral-300',NULL,'97694946bd63352dabf9f58233f87720',NULL,NULL,NULL,'2024-12-05 00:00:00',NULL),
(34,'--> 151454','JUAN MANUEL FLORES RODRIGUEZ','33034@operador_rf107','operador_rf107','1',0,0,33,'siemp_ixcotel','neutral-300',NULL,'34e66514ee84d757171138da92cf868a',NULL,NULL,NULL,'2024-12-18 00:00:00',NULL),
(35,'--> 151552','FILIGONIO HERRERA HERNANDEZ','33035@operador_rf159','operador_rf159','1',0,0,33,'siemp_ixcotel','neutral-300',NULL,'827ccb0eea8a706c4c34a16891f84e7b',NULL,NULL,NULL,'2025-01-01 00:00:00',NULL),
(37,'--> 151460','EDUARDO LOPEZ CHAVEZ','33037@operador_rf105','operador_rf105','1',0,0,33,'siemp_ixcotel','neutral-300',NULL,'202cb962ac59075b964b07152d234b70',NULL,NULL,NULL,'2025-01-22 00:00:00',NULL)

07 --> 151453
08 --> 151537
11 --> 151529
12 --> 151539
13 --> 151530
15 --> 151490
16 --> 151473
17 --> 151540
18 --> 151482
20 --> 151507
21 --> 151459
22 --> 150118
23 --> 151545
26 --> 151547
27 --> 151461
28 --> 151487
31 --> 151550
32 --> 150131
33 --> 151511
34 --> 151454
35 --> 151552
37 --> 151460


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
    UPDATE t_boleta  SET    u_operador_id = 151459   WHERE    u_operador_id = 21;       -- 0
    UPDATE t_boleta  SET    u_operador_id = 150118   WHERE    u_operador_id = 22;
    UPDATE t_boleta  SET    u_operador_id = 151545   WHERE    u_operador_id = 23;       -- 0
    UPDATE t_boleta  SET    u_operador_id = 151547   WHERE    u_operador_id = 26;
    UPDATE t_boleta  SET    u_operador_id = 151461   WHERE    u_operador_id = 27;
    UPDATE t_boleta  SET    u_operador_id = 151487   WHERE    u_operador_id = 28;       -- 0
    UPDATE t_boleta  SET    u_operador_id = 151550   WHERE    u_operador_id = 31;
    UPDATE t_boleta  SET    u_operador_id = 150131   WHERE    u_operador_id = 32;
    UPDATE t_boleta  SET    u_operador_id = 151511   WHERE    u_operador_id = 33;
    UPDATE t_boleta  SET    u_operador_id = 151454   WHERE    u_operador_id = 34;
    UPDATE t_boleta  SET    u_operador_id = 151552   WHERE    u_operador_id = 35;       -- 0
    UPDATE t_boleta  SET    u_operador_id = 330036   WHERE    u_operador_id = 36;
    UPDATE t_boleta  SET    u_operador_id = 151460   WHERE    u_operador_id = 37;       -- 0


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
    UPDATE t_boleta_cancelado  SET    u_operador_id = 151529 WHERE u_operador_id = 11;--0
    UPDATE t_boleta_cancelado  SET    u_operador_id = 151539 WHERE u_operador_id = 12;
    UPDATE t_boleta_cancelado  SET    u_operador_id = 151530 WHERE u_operador_id = 13;    
    UPDATE t_boleta_cancelado  SET    u_operador_id = 151490 WHERE u_operador_id = 15;--0
    UPDATE t_boleta_cancelado  SET    u_operador_id = 151473 WHERE u_operador_id = 16;--0    
    UPDATE t_boleta_cancelado  SET    u_operador_id = 151540 WHERE u_operador_id = 17;--0
    UPDATE t_boleta_cancelado  SET    u_operador_id = 151482 WHERE u_operador_id = 18;--0
    UPDATE t_boleta_cancelado  SET    u_operador_id = 151507 WHERE u_operador_id = 20;--0
    UPDATE t_boleta_cancelado  SET    u_operador_id = 151459 WHERE u_operador_id = 21;--0
    UPDATE t_boleta_cancelado  SET    u_operador_id = 150118 WHERE u_operador_id = 22;--0
    UPDATE t_boleta_cancelado  SET    u_operador_id = 151545 WHERE u_operador_id = 23;--0
    UPDATE t_boleta_cancelado  SET    u_operador_id = 151547 WHERE u_operador_id = 26;
    UPDATE t_boleta_cancelado  SET    u_operador_id = 151461 WHERE u_operador_id = 27;--0
    UPDATE t_boleta_cancelado  SET    u_operador_id = 151487 WHERE u_operador_id = 28;--0
    UPDATE t_boleta_cancelado  SET    u_operador_id = 151550 WHERE u_operador_id = 31;--0
    UPDATE t_boleta_cancelado  SET    u_operador_id = 150131 WHERE u_operador_id = 32;--0
    UPDATE t_boleta_cancelado  SET    u_operador_id = 151511 WHERE u_operador_id = 33;--0
    UPDATE t_boleta_cancelado  SET    u_operador_id = 151454 WHERE u_operador_id = 34;
    UPDATE t_boleta_cancelado  SET    u_operador_id = 151552 WHERE u_operador_id = 35;--0
    UPDATE t_boleta_cancelado  SET    u_operador_id = 330036 WHERE u_operador_id = 36;
    UPDATE t_boleta_cancelado  SET    u_operador_id = 151460 WHERE u_operador_id = 37;--0

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
    UPDATE t_concentrados  SET    id_operador = 151490 WHERE id_operador = 15;--0
    UPDATE t_concentrados  SET    id_operador = 151473 WHERE id_operador = 16;
    UPDATE t_concentrados  SET    id_operador = 151540 WHERE id_operador = 17;--0
    UPDATE t_concentrados  SET    id_operador = 151482 WHERE id_operador = 18;
    UPDATE t_concentrados  SET    id_operador = 151507 WHERE id_operador = 20;--0
    UPDATE t_concentrados  SET    id_operador = 151459 WHERE id_operador = 21;--0
    UPDATE t_concentrados  SET    id_operador = 150118 WHERE id_operador = 22;--0
    UPDATE t_concentrados  SET    id_operador = 151545 WHERE id_operador = 23;--0
    UPDATE t_concentrados  SET    id_operador = 151547 WHERE id_operador = 26;
    UPDATE t_concentrados  SET    id_operador = 151461 WHERE id_operador = 27;
    UPDATE t_concentrados  SET    id_operador = 151487 WHERE id_operador = 28;--0
    UPDATE t_concentrados  SET    id_operador = 151550 WHERE id_operador = 31;
    UPDATE t_concentrados  SET    id_operador = 150131 WHERE id_operador = 32;--0
    UPDATE t_concentrados  SET    id_operador = 151511 WHERE id_operador = 33;--0
    UPDATE t_concentrados  SET    id_operador = 151454 WHERE id_operador = 34;
    UPDATE t_concentrados  SET    id_operador = 151552 WHERE id_operador = 35;--0
    UPDATE t_concentrados  SET    id_operador = 330036 WHERE id_operador = 36;
    UPDATE t_concentrados  SET    id_operador = 151460 WHERE id_operador = 37;--0

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


    UPDATE t_reposicion  SET    id_usuario = 151453 WHERE id_usuario = 7;
    UPDATE t_reposicion  SET    id_usuario = 151537 WHERE id_usuario = 8;
    UPDATE t_reposicion  SET    id_usuario = 151529 WHERE id_usuario = 11;
    UPDATE t_reposicion  SET    id_usuario = 151539 WHERE id_usuario = 12;
    UPDATE t_reposicion  SET    id_usuario = 151530 WHERE id_usuario = 13;
    UPDATE t_reposicion  SET    id_usuario = 151540 WHERE id_usuario = 17;
    UPDATE t_reposicion  SET    id_usuario = 151482 WHERE id_usuario = 18;
    UPDATE t_reposicion  SET    id_usuario = 151507 WHERE id_usuario = 20;
    UPDATE t_reposicion  SET    id_usuario = 151459 WHERE id_usuario = 21;  
    UPDATE t_reposicion  SET    id_usuario = 150118 WHERE id_usuario = 22;
    UPDATE t_reposicion  SET    id_usuario = 151545 WHERE id_usuario = 23;
    UPDATE t_reposicion  SET    id_usuario = 151547 WHERE id_usuario = 26;
    UPDATE t_reposicion  SET    id_usuario = 151461 WHERE id_usuario = 27;
    UPDATE t_reposicion  SET    id_usuario = 151487 WHERE id_usuario = 28;
    UPDATE t_reposicion  SET    id_usuario = 151550 WHERE id_usuario = 31;
    UPDATE t_reposicion  SET    id_usuario = 150131 WHERE id_usuario = 32;
    UPDATE t_reposicion  SET    id_usuario = 151511 WHERE id_usuario = 33;
    UPDATE t_reposicion  SET    id_usuario = 151454 WHERE id_usuario = 34;
    UPDATE t_reposicion  SET    id_usuario = 151552 WHERE id_usuario = 35;
    UPDATE t_reposicion  SET    id_usuario = 151460 WHERE id_usuario = 37;