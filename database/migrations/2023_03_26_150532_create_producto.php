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
        Schema::create('producto', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('nombre');
            $table->string('codigo_categoria_venta')->default('');
            $table->string('modelo')->default('');
            $table->string('upc')->default(''); 
            $table->string('linea_codigo');
            $table->string('unidad_medida');
            $table->double('precio')->default(0);
            $table->double('existencias')->default(0);
            $table->enum('status', ['activo', 'inactivo'])->default('activo');
            $table->string('proveedor')->default('');
            $table->string('imagen')->default('');

            $table->enum('contiene_productos', ['si', 'no'])->default('no');
            $table->enum('permitir_venta', ['si', 'no'])->default('si');
            $table->enum('permitir_traslado', ['si', 'no'])->default('si');
            $table->enum('permitir_ajuste', ['si', 'no'])->default('si');
            $table->enum('permitir_cambio_precio_caja', ['si', 'no'])->default('no');
            $table->enum('permitir_cambio_nombre_caja', ['si', 'no'])->default('no');
            $table->enum('controlar_existencias', ['si', 'no'])->default('si');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto');
    }
};
