<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'url_imagen'
    ];

    public function roles(){
        return $this->hasMany(RolUsuarioPOS::class, 'usuario_pos_id');
    }
}
