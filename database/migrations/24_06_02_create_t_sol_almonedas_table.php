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
        Schema::create('t_sol_almonedas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('t_boleta_id')->constrained();            
            $table->date('fecha_movimiento');
            $table->date('fecha_vencimiento');
            $table->date('ultima_operacion')->nullable();
            $table->decimal('capital', 10, 2);
            $table->decimal('avaluo', 10, 2);
            $table->integer('tipo_empenio');
            $table->string('partida', 7)->nullable();   //P1, R3001, A5001, RA6001
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_sol_almonedas');
    }
};
