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
        Schema::create('traslado', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->dateTime('fecha_envio');
            $table->dateTime('fecha_recepcion_sucursal')->nullable();
            $table->dateTime('fecha_declinacion_sucursal')->nullable();
            $table->string('numero_documento');
            $table->string('codigo_origen');
            $table->string('codigo_destino');
            $table->string('centro_costo_origen');
            $table->string('centro_costo_destino');
            $table->enum('status', ['inicial', 'finalizado', 'cancelado'])->default('inicial');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('traslado');
    }
};
