<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bodega extends Model
{
    use HasFactory;

    protected $table = 'bodega';

    protected $fillable = [
        'nombre',
        'codigo_tienda',
        'empresa_id',
        'sucursal_id'
    ];
}
