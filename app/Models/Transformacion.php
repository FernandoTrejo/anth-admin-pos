<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transformacion extends Model
{
    use HasFactory;

    protected $table = 'transformacion';

    protected $fillable = [
        'codigo_caja',
        'codigo_sucursal',
        'uuid',
        'fecha',
        'codigo_usuario',
        'codigo_producto_origen',
        'cantidad_producto_origen',
        'costo_producto_origen',
        'codigo_producto_destino',
        'cantidad_producto_destino',
        'costo_producto_destino',
        'descripcion',
    ];
}
