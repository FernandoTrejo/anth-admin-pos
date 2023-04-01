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
            $table->string('unidad_medida');
            $table->integer('stock_minimo')->nullable();
            $table->integer('stock_maximo')->nullable();
            $table->string('tipo_costeo');
            $table->double('existencias');
            $table->double('costo_promedio');
            $table->double('peso')->default(0);
            $table->double('volumen')->default(0);
            $table->string('cuenta_contable')->nullable();
            $table->enum('status', ['A', 'B'])->default('A');
            $table->foreignId('empresa_id')->constrained('empresa');
            $table->string('linea_codigo');
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
