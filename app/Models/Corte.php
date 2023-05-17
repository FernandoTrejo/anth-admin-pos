<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Corte extends Model
{
    use HasFactory;

    protected $table = 'corte';

    protected $fillable = [
        'codigo',
        'tipo_corte', // mensual, diario, parcial
        'fecha_hora_corte',
        'fecha_fin_corte',
        'codigo_usuario',
        'codigo_sucursal',
        'codigo_caja',
        'usuario_code_cierre',
        'codigo_corte_diario',
        'codigo_corte_mensual',
    ];

    public function montosAsignados(): HasMany
    {
        return $this->hasMany(CorteMontoAsignado::class, 'corte_id');
    }
}
