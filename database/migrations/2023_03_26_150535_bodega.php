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
        Schema::create('bodega', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('codigo_tienda');
            $table->foreignId('empresa_id')->constrained('empresa');
            $table->foreignId('sucursal_id')->constrained('sucursal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bodega');
    }
};
