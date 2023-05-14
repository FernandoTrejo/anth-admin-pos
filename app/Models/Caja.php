<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Caja extends Model
{
    use HasFactory;

    protected $table = 'caja';

    protected $fillable = [
        'codigo',
        'titulo',
        'tipo',
        'sucursal_id' 
    ];

    public function numeradores() : HasMany{
        return $this->hasMany(Numerador::class, 'caja_id');
    }

    public function InfoTicket() : HasOne{
        return $this->hasOne(InfoEmisionTicket::class, 'caja_id');
    }

    public function InfoFactura() : HasOne{
        return $this->hasOne(InfoEmisionFactura::class, 'caja_id');
    }

    public function InfoCredito() : HasOne{
        return $this->hasOne(InfoEmisionCredito::class, 'caja_id');
    }
}
