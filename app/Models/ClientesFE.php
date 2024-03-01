<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientesFE extends Model
{
    use HasFactory;

    protected $table = 'clientes_factura_electronica';

    protected $fillable = [
        'nombre',
        'correo',
        'telefono',
        'pais',
        'departamento',
        'municipio',
        'direccion',
        'actividad',
        'iva',
        'nit',
        'responsable',
        'tipo_doc',
        'numero',
        'tipo_contribuyente'
    ];
}
