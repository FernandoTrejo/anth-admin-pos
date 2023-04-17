<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
