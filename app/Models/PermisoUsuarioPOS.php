<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermisoUsuarioPOS extends Model
{
    use HasFactory;

    protected $table = 'usuario_pos_permiso';

    protected $fillable = [
        'titulo'
    ];
}
