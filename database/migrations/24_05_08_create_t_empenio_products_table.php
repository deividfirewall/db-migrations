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
        Schema::create('t_empenio_products', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('contenido');
            $table->text('descripcion');
            $table->string('marca',64);
            $table->string('serie',96);
            $table->foreignId('t_empenio_id')->constrained();
            
            $table->timestamps();
        });
    }

    /** 
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_empenio_products');
    }
};
