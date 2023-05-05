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
        Schema::create('traslado_producto', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_producto');
            $table->integer('cantidad');
            $table->double('costo');
            $table->string('linea')->default('');
            $table->foreignId('traslado_id')->constrained('traslado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('traslado_producto');
    }
};
