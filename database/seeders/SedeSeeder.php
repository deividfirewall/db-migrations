<?php

namespace Database\Seeders;

use App\Models\AdmSede;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SedeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $sucursales = [
            [11, 'MIA', '030', 'nd','Miahuatlan', 0, 50000, 0, ' 57 2 0766', 1, 'Basilio J. Rojas 203, Centro, 70805 Miahuatlán de Porfirio Díaz, Oaxaca.', NULL, 2000, '1', NULL],
            [12, 'ABA', '002', 'Valles Centrales','Abastos', 15000, 25000, 100000, '51 6 5071', 2, 'Calle Valerio Trujano Num. 801 Col. Centro Oaxaca de Juarez, Oaxaca.', '68000', 2000, '1', NULL],
            [13, 'XOX', '006', 'Valles Centrales','Xoxo', 10000, 25000, 60000, '517 2850', 1, '1a Privada de Progreso No. 100 Esq. Boulevard Guadalupe Hinojosa, Santa Cruz Xoxocotlan, Oaxaca.', '71980', 2000, '1', NULL],
            [14, 'MOD', '012', 'Valles Centrales','Modulo Azul', 0, 25000, 150000, '518 7204', 2, 'Blvd Martires de Chicago y Ave. Proletariado Mexicano FOVISSSTE, Oaxaca de Jaurez, Oaxaca.', '68020', 2000, '1', NULL],
            [15, 'MAT', '000', 'Valles Centrales','Matriz', 1, 25000, 300000, '5016267', 2, 'Morelos #703 Col.Centro Oaxaca de Juarez', '68000', 2000, '1', NULL],
            [16, 'TEH', '001', 'Istmo','Tehuantepec', 1, 25000, 250000, '71 5 0082', 2, 'Av. Juana C. Romero No. 18 , Santo Domingo Tehuantepec, Oaxaca.', '70760', 2000, '1', NULL],
            [17, 'SAL', '007', 'Istmo','Salina Cruz', 1, 25000, 100000, '72 0 3026', 1, 'Avenida Manuel Ávila Camacho N0. 415, Salina Cruz, Oaxaca.', '70600', 2000, '1', NULL],
            [18, 'IXT', '011', 'Istmo','Ciudad Ixtepec', 1, 25000, 80000, '71 3 1567', 1, 'Calle Morelos No. 34, Colonia Estacion, Ciudad Ixtepec, Oaxaca.', '70110', 2000, '1', NULL],
            [19, 'J13', '013', 'Istmo','Juchitan 13', 1, 25000, 150000, '71 1 3289', 1, 'Calle Efraín R Gómez 15 C, Centro Juchitan de Zaragoza, Oaxaca', '70000', 2000, '1', NULL],
            [20, 'J14', '014', 'Istmo','juchitan 14', 1, 25000, 120000, '281 0862', 1, 'Valentín S. Carrasco 3, col centro, Juchitán, Oaxaca.', NULL, 2000, '1', NULL],
            [21, 'SBL', '017', 'Istmo','SanBlas', 1, 25000, 100000, '71 52 720', 1, 'Francisco Cortés esq Benito Juárez, San Blas Atempa, Oaxaca.', NULL, 2000, '1', NULL],
            [22, 'MRO', '015', 'Istmo','Matias Romero', 1, 25000, 100000, '7220972', 1, 'H. Ayuntamiento s/n entre Morelos y 5 de mayo sur, Matías Romero, Oaxaca.', NULL, 2000, '1', NULL],
            [23, 'POC', '019', 'Costa','Pochutla', 1, 25000, 70000, '58 40370', 1, 'Av. Lázaro Cárdenas Nº128 Esq. Allende, Col. Centro', NULL, 2000, '1', NULL],
            [24, 'PTO', '005', 'Costa','Puerto Escondido', 1, 25000, 80000, '58 21711', 2, '5a. Norte esq 2a. Poniente, Sector Juárez, Puerto Escondido, Oaxaca.', NULL, 2000, '1', NULL],
            [25, 'PIN', '010', 'Costa','Pinotepa', 1, 25000, 100000, '5432702', 1, 'Juárez 217 PB, Palacio Municipal, Pinotepa Nacional, Oaxaca.', NULL, 2000, '1', NULL],
            [26, 'TLC', '021', 'Valles Centrales','Tlacolula', 1, 25000, 80000, '56 20309', 1, 'Calle 2 de Abril Num. 20 esq. Calle Vicente Guerrero', '68000', 2000, '1', NULL],
            [27, 'JUD', '018', 'Valles Centrales','Judicial', 1, 25000, 40000, '9515016900 ext. 27024', 1, 'Centro Administrativo del Poder Ejecutivo y Judicial â€œGeneral Porfirio DÃ­az, Soldado de la Patriaâ€.', '71257', 2000, '1', NULL],
            [28, 'HUA', '003', 'Mixteca','Huajuapan', 1, 25000, 50000, '953- 53 21624', 1, 'Calle CuauhtÃ©moc No. 16', '69000', 2000, '1', NULL],
            [29, 'TLX', '020', 'Mixteca','Tlaxiaco', 1, 25000, 60000, '953 55 2 11 73', 1, 'Calle Aldama Num.6 entre las Calles Independencia e Hidalgo', '68000', 2000, '1', NULL],
            [30, '20N', '008', 'Valles Centrales','20 Noviembre', 1, 25000, 50000, '5144059', 1, '20 de noviembre 707 A, Col. Centro, Oaxaca.', NULL, 2000, '1', NULL],
            [31, 'TUX', '004', 'Cuenca','Tuxtepec', 1, 25000, 70000, '2878754055', 1, 'Avenida 20 de Noviembre No. 170 San Juan Bautista Tuxtepec', '68300', 2000, '1', NULL],
            [32, 'LBO', '009', 'Cuenca','Loma Bonita', 1, 25000, 40000, '281- 87 20003', 1, 'Calle Michoacán No. 25, local 3', '68400', 2000, '1', NULL],
            [33, 'IXC', '025', 'Cuenca','Ixcotel', 1, 25000, 100000, '951-513-79-83', 1, 'Carretera Internacional 1810-A Santa Maria Ixcotel, Santa Lucia del Camino', '68100', 2000, '1', NULL],
            [34, 'X26', '026', 'Cuenca','Xoxocotlan26', 1, 25000, 100000, '951-533-67-56', 1, 'Calle Pordirio Díaz, Paraje "Los Zapotales", Santa Cruz Xoxocotlán.', '68400', 2000, '1', NULL],
        ];

        foreach ($sucursales as $seed) {
            AdmSede::create([
                'id' => $seed[0],
                'serie' => $seed[1],
                'clave' => $seed[2],
                'region' => $seed[3],
                'sucursal' => $seed[4],
                'monto_max_concentrado' => $seed[5],
                'monto_max_prestamo' => $seed[6],
                'fondo_renvolvente' => $seed[7],
                'telefono' => $seed[8],
                'subastas' => $seed[9],
                'direccion' => $seed[10],
                'cp' => $seed[11],
                'monto_demasiaCheque' => $seed[12],
                'Activa' => $seed[13],
                'tenant_id' => $seed[14],
            ]);
        }

    }
}
