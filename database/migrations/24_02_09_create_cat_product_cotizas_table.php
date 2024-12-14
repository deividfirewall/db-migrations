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
        Schema::create('cat_product_cotizas', function (Blueprint $table) {
            $table->id();
            $table->integer('precio_min');
            $table->integer('precio_max');
            
            $table->decimal('por_aval',7,2)->nullable();
            $table->decimal('por_vc',7,2)->nullable();

            $table->foreignId('cat_product_sub_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cat_product_cotizas');
    }
};
