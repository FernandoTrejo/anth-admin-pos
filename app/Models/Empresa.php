<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $table = 'empresa';

    protected $fillable = [
        'codigo',
        'titulo',
        'descripcion',
        'actividad_economica',
        'direccion',
        'nrc',
        'nit',
        'iva'
    ];
}
