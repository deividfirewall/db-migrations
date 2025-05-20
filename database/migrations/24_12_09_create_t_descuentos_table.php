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
        Schema::create('t_descuentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('t_boleta_id')->constrained();
            $table->tinyInteger('cat_status_empenio_id');       // 3: Almoneda, 4: Subasta, 7: Vitrina
            $table->tinyInteger('cat_operacion_tipo_id');       // 2: Refrendo, 5: Desempeño
            $table->decimal('cobro', 8, 2);
            $table->dateTime('fecha');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('adm_sede_id')->constrained();
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_descuentos');
    }
};
