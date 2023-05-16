<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPrecio extends Model
{
    use HasFactory;

    protected $table = 'tipo_precio';

    protected $filable = [
        'titulo',
        'descripcion'
    ];
}
