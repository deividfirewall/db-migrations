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
        Schema::create('rpt_ge01_diarios', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('adm_sede_id')->constrained();
            $table->mediumInteger('num_desempenio')->default(0);
            $table->decimal('desempenio', 9, 2)->default(0);
            $table->mediumInteger('num_reposicion')->default(0);
            $table->decimal('reposicion', 8, 2)->default(0); 
            $table->mediumInteger('num_refrendos')->default(0);
            $table->decimal('refrendos', 8, 2)->default(0); 
            $table->mediumInteger('num_empenio')->default(0);
            $table->decimal('empenio', 9, 2)->default(0); 
            $table->mediumInteger('num_abono')->default(0);
            $table->decimal('abono', 8, 2)->default(0);
            $table->mediumInteger('num_venta_subasta')->default(0);
            $table->decimal('venta_subasta', 8, 2)->default(0);
            $table->mediumInteger('num_venta_mostrador')->default(0);
            $table->decimal('venta_mostrador', 9, 2)->default(0); 
            $table->decimal('caja_inicio', 11, 2)->default(0); 
            $table->decimal('caja_abonos', 9, 2)->default(0); 
            $table->decimal('consolidados', 8, 2)->default(0); 
            $table->decimal('corte_caja', 9, 2)->default(0); 
            $table->mediumInteger('num_refrendo_almo')->default(0);
            $table->decimal('refrendo_almo', 8, 2)->default(0); 
            $table->mediumInteger('num_desempenio_almo')->default(0);
            $table->decimal('desempenio_almo', 9, 2)->default(0); 
            $table->mediumInteger('num_reposicion_almo')->default(0);
            $table->decimal('reposicion_almo', 8, 2)->default(0); 
            $table->mediumInteger('num_demasia_almo')->default(0);
            $table->decimal('demasia_almo', 8, 2)->default(0); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rpt_ge01_diarios');
    }
};
