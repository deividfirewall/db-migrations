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
        Schema::create('t_cajas', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha');
            $table->decimal('caja', 10, 2)->default(0);
            $table->decimal('abono_caja', 10, 2)->default(0);
            $table->decimal('empenios', 10, 2)->default(0);
            $table->decimal('refrendos', 10, 2)->default(0);
            $table->decimal('abonos', 10, 2)->default(0);
            $table->decimal('desempenios', 10, 2)->default(0);
            $table->decimal('duplicado', 10, 2)->default(0);
            $table->decimal('venta_subasta', 10, 2)->default(0);
            $table->decimal('venta_vitrina', 10, 2)->default(0);
            $table->decimal('consolidados', 10, 2)->default(0);
            $table->integer('t_boleta_id')->default(0);
            $table->decimal('total_egresos', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_cajas');
    }
};
