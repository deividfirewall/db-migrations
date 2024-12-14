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
        Schema::create('cat_metal_precios', function (Blueprint $table) {
            $table->id();
            $table->string('base', 40);
            $table->decimal('gramos', 5, 2);
            $table->decimal('precio_compra', 8, 2);
            $table->decimal('precio_venta', 8, 2);
            $table->decimal('precio_gramo_venta', 7, 2);
            $table->decimal('precio_gramo', 7, 2);
            $table->foreignId('cat_metal_tipo_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cat_metal_precios');
    }
};
