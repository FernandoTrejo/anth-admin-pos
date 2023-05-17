<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaMovil extends Model
{
    use HasFactory;

    protected $table = 'venta_movil';

    protected $fillable = [
        'codigo',
        'fecha',
        'nombre_cliente',
        'total',
        'status',
        'codigo_vendedor',
        'codigo_caja',
        'codigo_sucursal',
        'codigo_usuario',
        'caja_id',
        'iva'
    ];
}
