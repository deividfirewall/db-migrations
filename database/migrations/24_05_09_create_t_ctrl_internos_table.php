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
        Schema::create('t_ctrl_internos', function (Blueprint $table) {
            $table->id();
            $table->char('letra');
            $table->integer('numero');
            $table->foreignId('t_boleta_id')->constrained();
            //$table->integer('sede_id');
            $table->date('fecha');
            $table->time('hora');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_ctrl_internos');
    }
};
