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
        Schema::create('pignorante_solidarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',128);
            $table->string('contacto',48);
            $table->string('parentesco',32);
            // $table->date('fecha_registro');      //se usara el created_at y updated_at
            // $table->foreignId('t_boleta_id')->constrained();
            $table->foreignId('pignorante_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pignorante_solidarios');
    }
};
