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
        Schema::create('transaccion', function (Blueprint $table) {
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
            $table->string('forma_pago')->default('');
            $table->string('descripcion')->default('');
            $table->string('referencia')->default('');
            $table->string('codigo_vendedor')->default('');
            $table->string('codigo_caja');
            $table->string('codigo_sucursal');
            $table->string('codigo_usuario');
            $table->string('tipo_transaccion');
            $table->foreignId('caja_id')->constrained('caja');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaccion');
    }
};
