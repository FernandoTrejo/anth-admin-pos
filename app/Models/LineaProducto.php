<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineaProducto extends Model
{
    use HasFactory;

    protected $table = 'linea_producto';

    protected $fillable = [
        'codigo',
        'nombre',
        'empresa_id'
    ];
}
