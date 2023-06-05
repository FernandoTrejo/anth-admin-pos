<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'cliente';

    protected $fillable = [
        'codigo',
        'nombre_cliente',
        'nrc',
        'nit',
        'dui',
        'direccion',
        'actividad_economica',
        'tipo_cliente',
    ];
}
