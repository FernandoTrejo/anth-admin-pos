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
        Schema::create('bodega_producto', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_producto');
            $table->string('nombre_producto');
            $table->string('costo_producto');
            $table->string('precio_producto');
            $table->string('linea_producto_codigo');
            $table->string('categoria_producto_codigo');
            $table->foreignId('producto_id')->constrained('producto');
            $table->foreignId('bodega_id')->constrained('bodega');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bodega_producto');
    }
};
