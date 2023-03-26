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
        Schema::create('info_emision_c_fiscal', function (Blueprint $table) {
            $table->id();
            $table->string('numero_serie');//numero de serie de los documentos a emitir
            $table->string('rango_documentos');//rango de documentos autorizados
            $table->string('numero_resolucion');//numero y fecha de resolución de los documentos (tickets)
            $table->date('fecha_resolucion');
            $table->string('nombre_empresa');
            $table->string('nit_empresa');
            $table->string('lugar_emision');
            $table->foreignId('sucursal_id')->constrained('sucursal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_emision_c_fiscal');
    }
};
