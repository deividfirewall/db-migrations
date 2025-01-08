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
        Schema::create('t_compradors', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('ine')->nullable()->unique();
            $table->string('rfc')->nullable()->unique();
            $table->string('celular',)->nullable();
            $table->string('tarjeta')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_compradors');
    }
};
