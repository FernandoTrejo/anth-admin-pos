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
        Schema::create('ajuste_producto', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_producto');
            $table->integer('cantidad');
            $table->double('costo_unitario');
            $table->double('costo_total');
            $table->foreignId('ajuste_id')->constrained('ajuste');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ajuste_producto');
    }
};
