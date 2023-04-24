<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class RolUsuarioPOS extends Model
{
    use HasFactory;
    

    protected $table = 'usuario_pos_rol';

    protected $fillable = [
        'titulo'
    ];

    public function users(){
        return $this->hasMany(UsuarioPOS::class, 'rol_id');
    }

    public function permissions() : BelongsToMany{
        return $this->belongsToMany(PermisoUsuarioPOS::class, 'usuario_pos_rol_permiso', 'rol_id', 'permiso_id');
    }
}
