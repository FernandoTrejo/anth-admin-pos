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
        Schema::create('otro_ingreso', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('numero_transaccion');
            $table->dateTime('fecha');
            $table->string('nombre_cliente');
            $table->double('total');
            $table->string('status');
            $table->string('corte_mensual');
            $table->string('corte_diario');
            $table->string('corte_parcial');
            $table->string('tipo_documento_clave');
            $table->string('forma_pago');
            $table->string('descripcion');
            $table->string('referencia');
            $table->string('codigo_caja');
            $table->string('codigo_usuario');
            $table->foreignId('caja_id')->constrained('caja');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('otro_ingreso');
    }
};
