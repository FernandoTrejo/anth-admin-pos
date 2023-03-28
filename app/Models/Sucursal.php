<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;

    protected $table = 'sucursal';

    protected $fillable = [
        'codigo',
        'nombre',
        'direccion',
        'telefono',
        'correo',
        'status',
        'empresa_id' 
    ];
}
