<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrecioProducto extends Model
{
    use HasFactory;

    protected $table = 'producto_menu_precio';

    protected $fillable = [
        'titulo',
        'descripcion',
        'precio',
        'producto_id',
    ];
}
