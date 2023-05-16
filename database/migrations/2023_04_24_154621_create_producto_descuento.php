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
        Schema::create('producto_descuento', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion')->default('');
            $table->double('porcentaje_descuento');
            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_fin');
            $table->string('fecha_inicio_timestamp');
            $table->string('fecha_fin_timestamp');

            $table->string('status');//activo inactivo
            $table->string('codigo_producto');//activo inactivo
            $table->foreignId('producto_id')->constrained('producto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto_descuento');
    }
};
