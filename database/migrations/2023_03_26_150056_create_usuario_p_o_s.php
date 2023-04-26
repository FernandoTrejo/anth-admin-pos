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
        Schema::create('usuario_pos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('usuario');
            $table->string('clave');
            $table->string('nombre_empleado');
            $table->string('tipo_empleado');//cajero, encargado, informatica
            $table->string('url_imagen');
            $table->string('status');//activo inactivo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario_pos');
    }
};
