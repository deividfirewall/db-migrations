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
        Schema::create('cat_metal_cotizas', function (Blueprint $table) {
            $table->id();
            $table->string('ref',8);
            $table->string('nombre',50);
            $table->decimal('kilates',5,2);
            $table->decimal('eq_oro',5,4);
            $table->decimal('por_vc',5,3)->nullable();
            $table->tinyInteger('por_cv')->nullable();
            $table->decimal('por_aval',5,2)->nullable();
            $table->foreignId('cat_metal_tipo_id')->constrained()->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cat_metal_cotizas');
    }
};
