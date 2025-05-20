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
        Schema::create('t_tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('t_boleta_id')->constrained();
            $table->tinyInteger('cat_status_empenio_id');      // 5: Desempeño, 6: Pago demasia, 11: Vta. Vitrina
            $table->dateTime('fecha');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_tickets');
    }
};
