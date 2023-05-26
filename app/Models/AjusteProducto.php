<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AjusteProducto extends Model
{
    use HasFactory;

    protected $table = 'ajuste_producto';

    protected $fillable = [
        'codigo_producto',
        'cantidad',
        'costo_unitario',
        'costo_total',
        'ajuste_id',
    ];
}
