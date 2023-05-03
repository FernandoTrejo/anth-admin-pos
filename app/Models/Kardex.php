<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kardex extends Model
{
    use HasFactory;

    protected $table = 'kardex';

    protected $fillable = [
        'codigo',
        'fecha_hora',
        'codigo_producto',
        'cantidad',
        'costo',
        'precio',
        'precio_sin_descuento',
        'tipo_movimiento',
        'numero_documento',
        'status',
        'codigo_orden',
        'centro_costo',
        'clave_sucursal',
        'clave_caja',
        'proveedor_cliente',
        'tipo_transaccion',
    ];
}
