<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaContieneProducto extends Model
{
    use HasFactory;

    protected $table = 'categoria_contiene_producto';

    protected $fillable = [
        'categoria_id',
        'producto_id'
    ];
}
