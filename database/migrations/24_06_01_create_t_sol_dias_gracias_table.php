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
        Schema::create('t_sol_dias_gracias', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_movimiento');
            $table->date('fecha_vencimiento');
            $table->foreignId('t_boleta_id')->constrained();
            $table->integer('tipo_empenio');
            $table->integer('dias_gracia');
            $table->decimal('prestamo', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_sol_dias_gracias');
    }
};
