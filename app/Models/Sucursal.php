<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sucursal extends Model
{
    use HasFactory;

    protected $table = 'sucursal';

    protected $fillable = [
        'codigo',
        'nombre',
        'direccion',
        'telefono',
        'correo',
        'status'
    ];


    public function formasPago() : BelongsToMany{
        return $this->belongsToMany(FormaPago::class, 'forma_pago_sucursal', 'sucursal_id', 'forma_pago_id');
    }
}
