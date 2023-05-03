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
        Schema::create('estado_inventario_dia', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('codigo_producto');
            $table->string('clave_sucursal');
            $table->integer('cantidad')->default(0);
            $table->double('costo_articulo')->default(0);
            $table->double('costo_total')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estado_inventario_dia');
    }
};
