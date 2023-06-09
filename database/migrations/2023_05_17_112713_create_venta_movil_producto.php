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
        Schema::create('venta_movil_producto', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_producto');
            $table->string('nombre_producto');
            $table->double('precio');
            $table->double('costo');
            $table->integer('cantidad');
            $table->double('subtotal');
            $table->double('porcentaje_descuento')->default(0);
            $table->double('valor_descuento')->default(0);
            $table->double('precio_sin_descuento');
            $table->string('codigo_orden');
            $table->string('codigo_corte_x');

            $table->double('iva');
            $table->string('motivo_descuento')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venta_movil_producto');
    }
};
