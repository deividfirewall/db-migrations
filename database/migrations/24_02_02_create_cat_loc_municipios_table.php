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
        Schema::create('cat_loc_municipios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cat_loc_estado_id')->constrained();
            $table->mediumInteger('clave');
            $table->string('municipio',50);
            $table->string('sigla',4);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cat_loc_municipios');
    }
};
