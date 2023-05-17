<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaMovilProducto extends Model
{
    use HasFactory;

    protected $table = 'venta_movil_producto';

    protected $fillable = [
        'codigo_producto',
        'nombre_producto',
        'precio',
        'costo',
        'cantidad',
        'subtotal',
        'porcentaje_descuento',
        'valor_descuento',
        'precio_sin_descuento',
        'codigo_orden',
        'codigo_corte_x',
        'iva',
        'motivo_descuento',
    ];
}
