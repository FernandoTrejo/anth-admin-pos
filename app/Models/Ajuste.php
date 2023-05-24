<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ajuste extends Model
{
    use HasFactory;

    protected $table = 'ajuste';

    protected $fillable = [
        'fecha',
        'codigo_sucursal',
        'tipo',
        'usuario_id',
        'referencia',
        'observaciones',
        'status',
        'codigo_usuario_autoriza',
        'fecha_autorizacion',
        'codigo_usuario_rechaza',
        'fecha_denegado'
    ];
}
