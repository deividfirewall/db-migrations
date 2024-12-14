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
        Schema::create('pignorantes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('ine')->unique();
            $table->string('rfc')->nullable()->unique();
            $table->string('celular',)->nullable();
            $table->string('telefono')->nullable();
            $table->string('email',96)->nullable();
            $table->integer('cp');
            $table->integer('estado_id');
            $table->integer('municipio_id');
            $table->string('direccion')->nullable();
            $table->string('identidad_frente')->nullable();
            $table->string('identidad_reverso')->nullable();
            $table->integer('pignorante_solidario_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pignorantes');
    }
};
