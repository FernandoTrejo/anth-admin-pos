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
        Schema::create('transaccion_pagos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_pago');
            $table->string('emisor');
            $table->double('recibido');
            $table->double('vuelto');
            $table->string('codigo_orden');
            $table->string('numero_autorizacion');
            $table->string('numero_telefono');
            $table->string('ultimos_digitos_tarjeta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaccion_pagos');
    }
};
