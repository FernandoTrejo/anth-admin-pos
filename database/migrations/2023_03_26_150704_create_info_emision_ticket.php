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
        Schema::create('info_emision_ticket', function (Blueprint $table) {
            $table->id();
            $table->string('autorizacion_caja')->default('')->nullable();// autorización de la caja registradora
            $table->string('numero_serie')->default('')->nullable();//numero de serie de los documentos a emitir
            $table->string('rango_documentos')->default('')->nullable();//rango de documentos autorizados
            $table->string('numero_resolucion')->default('')->nullable();//numero y fecha de resolución de los documentos (tickets)
            $table->string('fecha_resolucion')->default('')->nullable();
            $table->string('nombre_empresa')->default('')->nullable();
            $table->string('nit_empresa')->default('')->nullable();
            $table->string('lugar_emision')->default('')->nullable();
            $table->foreignId('caja_id')->constrained('caja');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_emision_ticket');
    }
};
