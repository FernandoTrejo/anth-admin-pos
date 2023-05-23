<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Producto extends Model
{
    use HasFactory;
    protected $table = 'producto';

    protected $fillable = [
        'codigo',
        'nombre',
        'codigo_categoria_venta',
        'modelo',
        'upc',
        'linea_codigo',
        'unidad_medida',
        'precio',
        'existencias',
        'status',
        'proveedor',
        'imagen',
        'permitir_venta',
        'permitir_traslado',
        'permitir_ajuste',
        'permitir_cambio_precio_caja',
        'permitir_cambio_nombre_caja',
        'controlar_existencias',
        'costo_promedio',
        'updated_at'
    ];

    public function ProductosContenidos() : HasMany{
        return $this->hasMany(ProductoContenido::class, 'producto_id');
    }

    public function precios() : BelongsToMany{
        return $this->belongsToMany(TipoPrecio::class, 'producto_menu_precio', 'producto_id', 'precio_id')->withPivot('precio');
    }

    public function descuentos() : HasMany{
        return $this->hasMany(DescuentoProducto::class, 'producto_id');
    }

    public function derivados() : HasMany{
        return $this->hasMany(ProductoDerivado::class, 'producto_id');
    }
}
