<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BodegaProducto extends Model
{
    use HasFactory;

    protected $table = 'bodega_producto';

    protected $fillable = [
        'fecha',
        'codigo_producto',
        'costo_producto',
        'clave_sucursal',
        'existencias',
    ];
}
