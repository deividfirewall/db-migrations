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
        Schema::create('t_sol_subastas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_subasta');
            $table->foreignId('t_boleta_id')->constrained();
            $table->decimal('capital', 10, 2);
            $table->decimal('avaluo', 10, 2);
            $table->integer('tipo_empenio');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_sol_subastas');
    }
};
