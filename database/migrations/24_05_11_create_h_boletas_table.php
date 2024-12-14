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
        Schema::create('h_boletas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('t_boleta_id')->unsigned();
            $table->decimal('prestamo', 10, 2)->default(0);
            $table->decimal('avaluo', 10, 2);
            //$table->decimal('interes', 10, 2)->default(0);          //no hay datos en la tabla
            $table->decimal('recargo', 10, 2)->default(0);
            $table->decimal('abono', 10, 2)->default(0);
            $table->dateTime('fecha_movimiento');
            $table->dateTime('fecha_vencimiento');
            $table->Integer('cat_status_empenio_id');
            $table->Integer('cat_operacion_tipo_id');
            $table->Integer('pignorante_id');
            //$table->Integer('user_id');
            $table->foreignId('user_id')->constrained();
            $table->Integer('tipo_empenio');
            $table->string('modificado')->nullable();
            $table->decimal('interes_vencido', 10, 2)->default(0);
            $table->decimal('comision_almacenaje', 10, 2)->default(0);  //no hay datos en la tabla
            $table->decimal('comision_avaluo', 10, 2)->default(0);  //no hay datos en la tabla
            $table->decimal('comision_almoneda', 10, 2)->default(0);
            $table->integer('compuesto')->default(0);
            //$table->integer('ban_modificar')->default(0);               //no hay datos en la tabla
            //$table->integer('ban_cancelar')->default(0);                //no hay datos en la tabla
            $table->integer('ban_retroceso')->default(0);
            $table->integer('ban_almoneda')->default(0);                
            //lo quitamos $table->integer('status_alternativo')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('h_boletas');
    }
};
