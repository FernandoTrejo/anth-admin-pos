<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudOperacionTienda extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'solicitud_operaciones_tiendas';

    protected $fillable = [
        'id',
        'codigo',
        'fecha_solicitud',
        'codigo_usuario_solicitante',
        'id_usuario_gestion',
        'status',
        'fecha_resolucion',
        'tipo_solicitud',
        'codigo_sucursal',
        'codigo_caja'
    ];
}
