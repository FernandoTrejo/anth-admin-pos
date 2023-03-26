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
        Schema::create('corte_montos_asignados', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_tipo_pago');
            $table->string('tipo_pago');
            $table->double('monto');
            $table->dateTime('fecha');
            $table->double('total_calculado');
            $table->foreignId('corte_id')->constrained('corte');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('corte_montos_asignados');
    }
};
