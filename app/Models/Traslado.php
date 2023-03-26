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
        'codigo_origen',
        'codigo_destino'
    ];

    public function productos() : HasMany{
        return $this->hasMany(TrasladoProducto::class, 'traslado_id');
    }
}
