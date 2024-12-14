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
        Schema::create('cat_prestamo_tipo_sedes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cat_prestamo_tipo_id')->constrained();
            $table->foreignId('adm_sede_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cat_prestamo_tipo_sedes');
    }
};
