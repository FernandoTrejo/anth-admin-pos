<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function productos(){
        return $this->hasMany(ProductoMenu::class, 'categoria_menu_id', 'id');
    }
    
}
