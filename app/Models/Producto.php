<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $table = 'producto';

    protected $fillable = [
        'codigo',
        'nombre',
        'unidad_medida',
        'stock_minimo',
        'stock_maximo',
        'tipo_costeo',
        'existencias',
        'costo_promedio',
        'peso',
        'volumen',
        'cuenta_contable',
        'status',
        'empresa_id',
        'linea_codigo'
    ];
}
