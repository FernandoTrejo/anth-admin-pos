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
        Schema::create('producto_menu_precio', function (Blueprint $table) {
            $table->id();
            $table->double('precio');
            $table->foreignId('producto_id')->constrained('producto');
            $table->foreignId('precio_id')->constrained('tipo_precio');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto_menu_precio');
    }
};
