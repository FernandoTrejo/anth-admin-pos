<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioRolAsignado extends Model
{
    use HasFactory;

    protected $table = 'usuario_rol_asignado';

    protected $fillable = [
        'rol_id',
        'usuario_id'
    ];
    
}
