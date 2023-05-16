<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DescuentoProducto extends Model
{
    use HasFactory;
    protected $table = 'producto_descuento';

    protected $fillable = [
        'descripcion',
        'porcentaje_descuento',
        'fecha_inicio',
        'fecha_inicio_timestamp',
        'fecha_fin',
        'fecha_fin_timestamp',
        'status',
        'codigo_producto',
        'producto_id',
    ];
}
