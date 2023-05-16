<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrecioProducto extends Model
{
    use HasFactory;

    protected $table = 'producto_menu_precio';

    protected $fillable = [
        'precio',
        'producto_id',
        'precio_id'

    ];
}
