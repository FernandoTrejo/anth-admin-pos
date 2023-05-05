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
        'cantidad',
        'costo',
        'linea',
        'traslado_id',
    ];


    public function traslado(): BelongsTo
    {
        return $this->belongsTo(Traslado::class);
    }

}
