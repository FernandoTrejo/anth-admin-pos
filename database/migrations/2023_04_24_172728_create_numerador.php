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
        Schema::create('numerador', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_documento');
            $table->string('nombre');
            $table->string('prefijo');
            $table->string('numeracion');
            $table->integer('inicio');
            $table->integer('fin');
            $table->integer('actual');
            $table->foreignId('caja_id')->constrained('caja');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('numerador');
    }
};
