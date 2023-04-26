<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class UsuarioPOS extends Model
{
    use HasFactory;

    protected $table = 'usuario_pos';

    protected $fillable = [
        'codigo',
        'usuario',
        'clave',
        'nombre_empleado',
        'tipo_empleado', //cajero, encargado, informatica
        'url_imagen',
        'status'
    ];

    public function roles() : BelongsToMany{
        return $this->belongsToMany(RolUsuarioPOS::class, 'usuario_pos_rol_asignado', 'usuario_pos_id', 'rol_id');
    }
}
