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
        Schema::create('categoria_contiene_producto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categoria_id')->constrained('categoria_producto_menu');
            $table->foreignId('producto_id')->constrained('producto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categoria_contiene_producto');
    }
};
