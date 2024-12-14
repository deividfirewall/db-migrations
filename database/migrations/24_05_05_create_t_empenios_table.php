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
        Schema::create('t_empenios', function (Blueprint $table) {
            $table->id();
            $table->decimal('avaluo',8,2);
            $table->decimal('prestamo',8,2);
            $table->decimal('maximo',8,2);
            $table->decimal('minimo',8,2);      
            $table->integer('cat_status_empenio_id');      
            $table->integer('cat_prestamo_tipo_id');
            $table->foreignId('pignorante_id')->constrained();
            $table->integer('cat_product_sub_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_empenios');
    }
};
