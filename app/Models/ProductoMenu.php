<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoMenu extends Model
{
    use HasFactory;

    protected $table = 'producto_menu';

    protected $fillable = [
        'codigo',
        'nombre',
        'imagen',
        'precio',
        'status',
        'categoria_menu_id'
    ];
}
