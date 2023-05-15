<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoDerivado extends Model
{
    use HasFactory;

    protected $table = 'producto_derivado';

    protected $fillable = [
        'codigo_producto',
        'cantidad',
        'producto_id'
    ];
}
