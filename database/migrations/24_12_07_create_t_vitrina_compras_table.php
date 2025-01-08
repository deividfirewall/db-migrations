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
        Schema::create('t_vitrina_compras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('t_boleta_id')->constrained();
            $table->foreignId('t_subasta_id')->constrained();
            $table->foreignId('t_comprador_id')->constrained();
            $table->decimal('cantidad', 8, 2);
            $table->datetime('fecha');
            $table->tinyInteger('procedencia_venta');
            $table->decimal('precioVenta', 8, 2);
            $table->decimal('capital', 8, 2);
            $table->decimal('intNormal', 8, 2);
            $table->decimal('intVencido', 8, 2);
            $table->decimal('intAvaluo', 8, 2);
            $table->decimal('abonos', 8, 2);
            $table->decimal('totalVenta', 8, 2);
            $table->decimal('comisionVenta', 8, 2);
            $table->decimal('comisionAlmacenaje', 8, 2);
            $table->decimal('demasia', 8, 2);
            $table->tinyInteger('cat_status_demasia_id');
            $table->integer('numcheque');
            $table->integer('retasa');
            $table->date('fecha_pago')->nullable();
            $table->string('num_tarjeta', 64)->nullable();
            $table->integer('lee_reg');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_vitrina_compras');
    }
};
