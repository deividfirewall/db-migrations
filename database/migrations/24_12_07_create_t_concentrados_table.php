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
        Schema::create('t_concentrados', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->time('hora');
            $table->decimal('cantidad_concentrada', 10, 2);
            $table->decimal('cantidad_restante', 10, 2);
            $table->foreignId('operador_id')->constrained(table: 'users', column: 'id', indexName: 'user_operador_foreign_id');
            $table->foreignId('gerente_id')->constrained(table: 'users', column: 'id', indexName: 'user_gerente_foreign_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_concentrados');
    }
};
