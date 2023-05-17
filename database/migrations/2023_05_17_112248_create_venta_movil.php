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
        Schema::create('venta_movil', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->dateTime('fecha');
            $table->string('nombre_cliente')->default('');
            $table->double('total');
            $table->string('status');
            $table->string('codigo_vendedor')->default('');
            $table->string('codigo_caja');
            $table->string('codigo_sucursal');
            $table->string('codigo_usuario');
            $table->foreignId('caja_id')->constrained('caja');
            $table->double('iva')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venta_movil');
    }
};
