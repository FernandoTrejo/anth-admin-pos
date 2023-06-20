<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ajuste extends Model
{
    use HasFactory;

    protected $table = 'ajuste';

    protected $fillable = [
        'numero',
        'fecha',
        'codigo_sucursal',
        'tipo',
        'usuario_id',
        'referencia',
        'observaciones',
        'status',
        'codigo_usuario_autoriza',
        'fecha_autorizacion',
        'codigo_usuario_rechaza',
        'fecha_denegado',
        'etiqueta'
    ];

    public function productos() : HasMany{
        return $this->hasMany(AjusteProducto::class, 'ajuste_id');
    }
}
