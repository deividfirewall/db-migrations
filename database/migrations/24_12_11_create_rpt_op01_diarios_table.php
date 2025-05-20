<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rpt_op01_diarios', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->foreignId('adm_sede_id')->constrained();
            $table->decimal('desempenio', 9,2)->default(0);
            $table->decimal('desempenio_acu', 10,2)->default(0);
            $table->decimal('refrendo', 8,2)->default(0);
            $table->decimal('refrendo_acu', 9,2)->default(0);
            $table->decimal('abono', 9,2)->default(0);
            $table->decimal('abono_acu', 9,2)->default(0);
            $table->decimal('venta', 9,2)->default(0);
            $table->decimal('venta_acu', 9,2)->default(0);
            $table->decimal('reposicion', 8,2)->default(0);
            $table->decimal('reposicion_acu', 8,2)->default(0);
            $table->decimal('acredores_demasia', 8,2)->default(0);
            $table->decimal('acredores_demasia_acu', 8,2)->default(0);
            $table->decimal('empenios', 9,2)->default(0);
            $table->decimal('empenios_acu', 10,2)->default(0);
            $table->decimal('demasia', 8,2)->default(0);
            $table->decimal('demasia_acu', 8,2)->default(0);
            $table->mediumInteger('cant_empenios')->default(0);
            $table->mediumInteger('cant_empenios_acu')->default(0);
            $table->mediumInteger('cant_desempenio')->default(0);
            $table->mediumInteger('cant_desempenio_acu')->default(0);
            $table->mediumInteger('cant_refrendo')->default(0);
            $table->mediumInteger('cant_refrendo_acu')->default(0);
            $table->mediumInteger('cant_abono')->default(0);
            $table->mediumInteger('cant_abono_acu')->default(0);
            $table->mediumInteger('cant_venta')->default(0);
            $table->mediumInteger('cant_venta_acu')->default(0);
            $table->mediumInteger('cant_reposicion')->default(0);
            $table->mediumInteger('cant_reposicion_acu')->default(0);
            $table->mediumInteger('cant_demasia')->default(0);
            $table->mediumInteger('cant_demasia_acu')->default(0);
            $table->mediumInteger('cant_demasia_cheque')->default(0);
            $table->mediumInteger('cant_demasia_cheque_acu')->default(0);
            $table->decimal('comision_desempenio_alm', 8,2)->default(0);
            $table->decimal('comision_desempenio_alm_acu', 8,2)->default(0);
            $table->decimal('comision_venta_alm', 8,2)->default(0);
            $table->decimal('comision_venta_alm_acu', 8,2)->default(0);
            $table->decimal('comision_refrendo_alm', 8,2)->default(0); 
            $table->decimal('comision_refrendo_alm_acu', 8,2)->default(0); 
            $table->decimal('capital_recuperadoDesmp', 9,2)->default(0);
            $table->decimal('capital_recuperadoDesmp_acu', 9,2)->default(0);
            $table->decimal('capital_recuperadoVentas', 9,2)->default(0);
            $table->decimal('capital_recuperadoVentas_acu', 9,2)->default(0);
            $table->decimal('demasia_pagada_che', 8,2)->default(0); 
            $table->decimal('demasia_pagada_che_acu', 8,2)->default(0); 
            $table->decimal('capital_refrendado', 9,2)->default(0);
            $table->decimal('capital_refrendado_acu', 10,2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rpt_op01_diarios');
    }
};
