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
        Schema::create('corte', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('tipo_corte'); // mensual, diario, parcial
            $table->dateTime('fecha_hora_corte');
            $table->dateTime('fecha_fin_corte')->nullable();
            $table->string('codigo_usuario');
            $table->string('codigo_sucursal');
            $table->string('codigo_caja');
            $table->string('usuario_code_cierre');
            $table->string('codigo_corte_diario');
            $table->string('codigo_corte_mensual');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('corte');
    }
};
