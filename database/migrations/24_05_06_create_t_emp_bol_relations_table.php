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
        Schema::create('t_emp_bol_relations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('t_empenio_id')->constrained();
            $table->foreignId('t_boleta_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_emp_bol_relations');
    }
};
