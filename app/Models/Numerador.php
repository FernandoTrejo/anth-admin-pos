<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Numerador extends Model
{
    use HasFactory;

    protected $table = 'numerador';

    protected $fillable = [
        'tipo_documento',
        'nombre',
        'prefijo',
        'numeracion',
        'inicio',
        'fin',
        'actual',
        'caja_id'
    ];
}
