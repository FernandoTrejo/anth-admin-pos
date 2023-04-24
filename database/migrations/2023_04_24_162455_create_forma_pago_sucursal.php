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
        Schema::create('forma_pago_sucursal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('forma_pago_id')->constrained('forma_pago');
            $table->foreignId('sucursal_id')->constrained('sucursal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forma_pago_sucursal');
    }
};
