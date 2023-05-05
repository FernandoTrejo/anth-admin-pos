<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Traslado extends Model
{
    use HasFactory;

    protected $table = 'traslado';

    protected $fillable = [
        'uuid',
        'numero_documento',
        'codigo_origen',
        'codigo_destino',
        'centro_costo_origen',
        'centro_costo_destino',
        'status',
        'fecha_envio',
        'fecha_recepcion_sucursal',
        'fecha_declinacion_sucursal'
    ];

    public function productos(): HasMany
    {
        return $this->hasMany(TrasladoProducto::class, 'traslado_id');
    }
}
