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
            $table->date('fecha');
            $table->string('codigo_producto');
            $table->string('costo_producto');
            $table->string('clave_sucursal');
            $table->double('existencias');
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
