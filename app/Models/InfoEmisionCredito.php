<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoEmisionCredito extends Model
{
    use HasFactory;

    protected $table = 'info_emision_c_fiscal';

    protected $fillable = [
        'numero_serie',
        'rango_documentos',
        'numero_resolucion',
        'fecha_resolucion',
        'nombre_empresa',
        'nit_empresa',
        'lugar_emision',
        'caja_id',
    ];
}
