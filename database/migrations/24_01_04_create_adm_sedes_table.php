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
        Schema::create('adm_sedes', function (Blueprint $table) {
            $table->id();
            $table->char('serie',3);  //-> SUSTITUYE A SIGLA
            $table->string('clave',3);
            $table->string('sucursal',32);
            $table->string('region',32);
            $table->decimal('monto_max_prestamo',8,2)->default(0);
            $table->json('tipo_prenda')->nullable();
            $table->decimal('monto_max_concentrado',8,2)->default(0);
            $table->decimal('fondo_renvolvente',8,2)->default(0);
            $table->tinyInteger('subastas');
            $table->decimal('monto_demasiaCheque')->default(0);
            $table->string('telefono',24);
            $table->string('direccion',196);
            $table->integer('cp')->unsigned()->nullable();
            $table->string('sigla',3)->nullable(); //-> SE QUITARA!


            // $table->string('Horario',64)->nullable();
            $table->boolean('Activa')->nullable()->default(1);

            $table->string('tenant_id')->nullable();
            //$table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adm_sedes');
    }
};
