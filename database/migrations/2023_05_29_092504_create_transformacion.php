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
        Schema::create('transformacion', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->dateTime('fecha');
            $table->string('codigo_usuario');
            $table->string('codigo_producto_origen');
            $table->double('cantidad_producto_origen');
            $table->double('costo_producto_origen');
            $table->string('codigo_producto_destino');
            $table->double('cantidad_producto_destino');
            $table->double('costo_producto_destino');
            $table->string('codigo_caja');
            $table->string('codigo_sucursal');
            $table->string('descripcion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transformacion');
    }
};
