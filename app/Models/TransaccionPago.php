<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaccionPago extends Model
{
    use HasFactory;

    protected $table = 'transaccion_pagos';

    protected $fillable = [
        'tipo_pago',
        'emisor',
        'recibido',
        'vuelto',
        'codigo_orden',
        'numero_autorizacion',
        'numero_telefono',
        'ultimos_digitos_tarjeta'
    ];
}
