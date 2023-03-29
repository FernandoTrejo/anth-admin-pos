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
        Schema::create('traslado', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('numero_documento');
            $table->string('codigo_origen');
            $table->string('titulo_origen');
            $table->string('codigo_destino');
            $table->string('titulo_destino');
            $table->enum('status', ['inicial', 'finalizado', 'cancelado'])->default('inicial');
            $table->foreignId('empresa_id')->constrained('empresa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('traslado');
    }
};
