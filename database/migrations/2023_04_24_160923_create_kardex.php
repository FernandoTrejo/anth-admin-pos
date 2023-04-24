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
        Schema::create('kardex', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->dateTime('fecha_hora');
            $table->string('codigo_producto');
            $table->double('cantidad');
            $table->double('costo');
            $table->double('precio');
            $table->double('precio_sin_descuento');
            $table->string('tipo_movimiento');
            $table->string('numero_documento');
            $table->string('status');//active/inactive
            $table->string('codigo_orden');
            $table->string('centro_costo');
            $table->string('clave_sucursal');
            $table->string('clave_caja');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kardex');
    }
};
