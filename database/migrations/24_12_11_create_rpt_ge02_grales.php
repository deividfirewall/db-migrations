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
        Schema::create('rpt_ge02_grales', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->foreignId('adm_sede_id')->constrained();
            $table->mediumInteger('depositaria_reg_m')->default(0);
            $table->decimal('depositaria_cant_m', 10, 2)->default(0);
            $table->mediumInteger('depositaria_reg_v')->default(0);
            $table->decimal('depositaria_cant_v', 10, 2)->default(0);
            $table->mediumInteger('almoneda_reg_m')->default(0);
            $table->decimal('almoneda_cant_m', 10, 2)->default(0);
            $table->mediumInteger('almoneda_reg_v')->default(0);
            $table->decimal('almoneda_cant_v', 8, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rpt_ge02_grales');
    }
};
