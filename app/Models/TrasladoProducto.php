<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrasladoProducto extends Model
{
    use HasFactory;

    protected $table = 'traslado_producto';

    protected $fillable = [
        'codigo_producto',
        'nombre_producto',
        'imagen_url',
        'cantidad',
        'costo',
        'precio',
        'traslado_id'
    ];

    public function traslado(): BelongsTo
    {
        return $this->belongsTo(Traslado::class);
    }


    /*
        "codigo_producto": "",
        "nombre_producto": "",
        "imagen_url": "",
        "cantidad": 0,
        "costo": 0,
        "precio": 0
    */
}
