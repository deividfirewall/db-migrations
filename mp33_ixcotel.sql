$ gunzip -c mp_ixcotel_250430.sql.gz | ./vendor/bin/sail exec -T mysql mysql -u root mp_ixcotel
$ rm mp_ixcotel_250430.sql.gz

TRUNCATE `h_boletas`, 
`pignorantes`, 
`pignorante_solidarios`, 
`tables`, 
`t_boletas`, 
`t_boleta_pagos`, 
`t_cajas`, 
`t_compradors`, 
`t_concentrados`, 
`t_ctrl_internos`, 
`t_demasias_pagadas`, 
`t_empenios`, 
`t_empenio_metals`, 
`t_empenio_products`, 
`t_emp_bol_relations`, 
`t_reposicions`, 
`t_retasas`, 
`t_sol_almonedas`, 
`t_sol_dias_gracias`, 
`t_sol_subastas`, 
`t_subastas`, 
`t_subasta_fechas`, 
`t_suspencion_dias`, 
`t_vitrina_compras`, 
`t_vitrina_ventas`, 
`users`;



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

    UPDATE t_boleta  SET    u_operador_id = 151453   WHERE    u_operador_id = 7;
    UPDATE h_t_boleta SET u_operador_id = 151453   WHERE    u_operador_id = 7;
    UPDATE t_boleta_cancelado  SET    u_operador_id = 151453 WHERE u_operador_id = 7;
    UPDATE t_caja_monto_operador SET u_operadores_id = 151453 WHERE u_operadores_id = 7;
    UPDATE t_suspencion_dias  SET    u_operadores_id = 151453 WHERE u_operadores_id = 7;
    UPDATE t_concentrados  SET    id_operador = 151453 WHERE id_operador = 7;
    UPDATE t_descuentos  SET    id_operador = 151453 WHERE id_operador = 7;
    UPDATE r_ro_cg12    SET    id_operador = 151453 WHERE id_operador = 7;
    UPDATE t_reposicion  SET    id_usuario = 151453 WHERE id_usuario = 7;