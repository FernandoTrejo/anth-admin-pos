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
        Schema::create('ajuste', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha');
            $table->string('numero')->default('');
            $table->string('codigo_sucursal');
            $table->enum('tipo', ['favor', 'contra']);
            $table->foreignId('usuario_id')->constrained('users'); //usuario solicitante
            $table->string('referencia')->default('');
            $table->text('observaciones')->default('');
            $table->enum('status', ['pendiente_autorizacion', 'autorizado', 'denegado', 'cerrado'])->default('pendiente_autorizacion');
            $table->string('codigo_usuario_autoriza')->nullable();
            $table->dateTime('fecha_autorizacion')->nullable();
            $table->string('codigo_usuario_rechaza')->nullable();
            $table->dateTime('fecha_denegado')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ajuste');
    }
};
