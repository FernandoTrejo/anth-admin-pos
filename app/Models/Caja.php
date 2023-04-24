<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Caja extends Model
{
    use HasFactory;

    protected $table = 'caja';

    protected $fillable = [
        'codigo',
        'titulo',
        'sucursal_id' 
    ];

    public function numeradores() : HasMany{
        return $this->hasMany(Numerador::class, 'caja_id');
    }
}
