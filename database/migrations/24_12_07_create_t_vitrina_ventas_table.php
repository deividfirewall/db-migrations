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
        Schema::create('t_vitrina_ventas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_venta');
            $table->decimal('capital', 8, 2);
            $table->decimal('intNormal', 8, 2);
            $table->decimal('intVencido', 8, 2);
            $table->decimal('intAvaluo', 8, 2);
            $table->decimal('abonos', 8, 2);
            $table->decimal('totalVenta', 9, 2);
            $table->decimal('comisionVenta', 8, 2);
            $table->decimal('demasia', 8, 2);
            $table->integer('numReg');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_vitrina_ventas');
    }
};
