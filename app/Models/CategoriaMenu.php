<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CategoriaMenu extends Model
{
    use HasFactory;

    protected $table = 'categoria_producto_menu';

    protected $fillable = [
        'codigo',
        'nombre',
        'url',
        'status'
    ];

    public function productos() : BelongsToMany{
        return $this->belongsToMany(Producto::class, 'categoria_contiene_producto', 'categoria_id', 'producto_id');
    }
    
}
