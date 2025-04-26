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
        Schema::create('t_demasias_pagadas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->decimal('capital_insoluto', 9, 2);
            $table->decimal('int_comision', 8, 2);
            $table->decimal('precio_venta', 9, 2);
            $table->decimal('demasia', 8, 2);
            $table->decimal('demasia_efectivo', 8, 2);
            $table->decimal('demasia_cheque', 8, 2);
            $table->integer('num_reg');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_demasias_pagadas');
    }
};
