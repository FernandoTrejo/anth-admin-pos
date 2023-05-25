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
        Schema::create('estado_inventario_dia', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('codigo_producto');
            $table->string('clave_sucursal');
            $table->double('costo_articulo')->default(0);


            /*
            alter table `estado_inventario_dia` add column saldo DOUBLE AS (entradas - salidas);



            INSERT INTO `estado_inventario_dia`(`fecha`, `codigo_producto`, `clave_sucursal`, `costo_articulo`, `entradas`, `salidas`)
            SELECT 
            CURDATE(),
            k.codigo_producto, 
            k.clave_sucursal, 
            k.costo,
            (select sum(cantidad) from kardex where codigo_producto = k.codigo_producto and clave_sucursal = k.clave_sucursal and tipo_movimiento = 'entrada' and status = 'activo' and fecha_hora > DATE_SUB(CURDATE(), INTERVAL 1 DAY)) as entradas, 
            (select sum(cantidad) from kardex where codigo_producto = k.codigo_producto and clave_sucursal = k.clave_sucursal and tipo_movimiento = 'salida' and status = 'activo' and fecha_hora > DATE_SUB(CURDATE(), INTERVAL 1 DAY)) as salidas
            from kardex k
            where fecha_hora > DATE_SUB(CURDATE(), INTERVAL 1 DAY)
            group by k.codigo_producto, k.centro_costo;

             */
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estado_inventario_dia');
    }
};
