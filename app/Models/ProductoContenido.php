<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoContenido extends Model
{
    use HasFactory;

    protected $table = 'producto_contenido';
    protected $fillable = [
        'codigo_producto_contenido',
        'cantidad',
        'producto_id'
    ];
}
