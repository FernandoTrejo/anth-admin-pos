<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaccionProducto extends Model
{
    use HasFactory;

    protected $table = 'transaccion_producto';

    protected $fillable = [
        'codigo_producto',
        'nombre_producto',
        'precio',
        'cantidad',
        'subtotal',
        'porcentaje_descuento',
        'valor_descuento',
        'precio_sin_descuento',
        'codigo_orden',
        'codigo_corte_x',
    ];
}
