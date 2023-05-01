<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    use HasFactory;

    protected $table = 'transaccion';

    protected $fillable = [
        'codigo',
        'numero_transaccion',
        'fecha',
        'nombre_cliente',
        'total',
        'status',
        'corte_mensual',
        'corte_diario',
        'corte_parcial',
        'tipo_documento_clave',
        'forma_pago',
        'descripcion',
        'referencia',
        'codigo_vendedor',
        'codigo_caja',
        'codigo_sucursal',
        'codigo_usuario',
        'tipo_transaccion',
        'descuento_total',
        'caja_id'
    ];
}
