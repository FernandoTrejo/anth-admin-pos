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
        Schema::create('usuario_pos_rol_asignado', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rol_id')->constrained('usuario_pos_rol');
            $table->foreignId('usuario_pos_id')->constrained('usuario_pos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario_pos_rol_asignado');
    }
};
