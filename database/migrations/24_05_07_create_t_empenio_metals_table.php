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
        Schema::create('t_empenio_metals', function (Blueprint $table) {
            $table->id();
            $table->text('descripcion');
            $table->decimal('peso',8,2);
            $table->decimal('pesoTotal',8,2);
            $table->foreignId('t_empenio_id')->constrained();
            $table->integer('cat_metal_cotiza_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_empenio_metals');
    }
};
