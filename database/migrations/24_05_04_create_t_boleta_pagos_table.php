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
        Schema::create('t_boleta_pagos', function (Blueprint $table) {
            $table->id();
            $table->integer('num_pago');
            $table->date('fecha_pago');
            $table->decimal('prestamo',8,2);
            $table->decimal('refrendo',7,2);
            $table->decimal('capital_mas_interes',8,2);
            $table->foreignId('t_boleta_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_boleta_pagos');
    }
};
