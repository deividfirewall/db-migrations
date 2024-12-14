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
        Schema::create('cat_prestamo_tipos', function (Blueprint $table) {
            $table->id();   //Es la columna 'Clave' en la tabla original
            $table->string('ref',5);
            $table->string('nombre',50);
            $table->tinyInteger('tipo_empenio');
            $table->decimal('interes_semanal', 7, 2);
            $table->integer('plazos');
            $table->integer('dias_plazos');
            $table->integer('dias_gracia');
            $table->decimal('porcentaje_max', 5, 2);
            $table->decimal('porcentaje_min', 5, 2);
            $table->integer('resguardo');
            $table->boolean('activo')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cat_prestamo_tipos');
    }
};
