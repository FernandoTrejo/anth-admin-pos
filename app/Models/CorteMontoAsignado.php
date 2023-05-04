<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorteMontoAsignado extends Model
{
    use HasFactory;

    protected $table = 'corte_montos_asignados';

    protected $fillable = [
        'codigo_tipo_pago',
        'tipo_corte',
        'tipo_pago',
        'monto',
        'corte_id'
    ];
}
