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
        Schema::create('t_subastas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('t_boleta_id')->constrained()->restrictOnDelete(); 
            $table->bigInteger('t_subasta_fecha_id');       // $table->date('fecha_subasta');
            $table->integer('cat_status_subasta_id');
            $table->decimal('precio_sugerido',9,2);
            $table->decimal('precio_venta_subasta',9,2)->default(0);
            // $table->foreignId('adm_sede_id')->constrained()->restrictOnDelete();
            // $table->float('demasia');        // suma total:0 de las demasias en 10 años
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subastas');
    }
};
