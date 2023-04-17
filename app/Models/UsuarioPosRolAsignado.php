<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioPosRolAsignado extends Model
{
    use HasFactory;

    protected $table = 'usuario_pos_rol_asignado';

    protected $fillable = [
        'rol_id',
        'usuario_pos_id'
    ];
    
}
