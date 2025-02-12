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
        Schema::create('t_subasta_fechas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_subasta');
            $table->boolean('visible')->default(true);
            $table->integer('tipo_empenio');
            $table->tinyInteger('cat_status_subasta_id')->default(1);  //1:Activa, 2:Cerrada
            $table->decimal('capital',8,2)->default(0.0);
            $table->decimal('intNormal',8,2)->default(0.0);
            $table->decimal('intVencido',8,2)->default(0.0);
            $table->decimal('intAvaluo',8,2)->default(0.0);
            $table->decimal('abonos',8,2)->default(0.0);
            $table->decimal('totalVenta',8,2)->default(0.0);
            $table->decimal('comisionVenta',8,2)->default(0.0);
            $table->decimal('demasia',8,2)->default(0.0);
            $table->integer('numReg')->default(0);
            $table->foreignId('adm_sede_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_subasta_fechas');
    }
};
