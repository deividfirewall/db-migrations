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
        Schema::create('t_reposicions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('t_boleta_id')->constrained();
            $table->decimal('prestamo', 8, 2);
            $table->decimal('cargo', 8, 2);
            $table->tinyInteger('tipo_empenio');                            
            $table->foreignId('pignorante_id')->nullable()->constrained();      //EL NULLABLE SOLO ES PARA ESTA MIGRACION
            $table->tinyInteger('cat_status_empenio_id');
            $table->foreignId('user_id')->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_reposicions');
    }
};
