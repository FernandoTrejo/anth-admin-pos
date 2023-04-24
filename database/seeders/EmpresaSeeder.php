<?php

namespace Database\Seeders;

use App\Models\Bodega;
use App\Models\Caja;
use App\Models\CategoriaProducto;
use App\Models\Empresa;
use App\Models\Producto;
use App\Models\Sucursal;
use App\Models\UsuarioPOS;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //creacion de empresa
        $empresa = Empresa::create(
            [
                'codigo' => 'f6e1c9cf-7188-4dfb-962b-e2428266428c',
                'titulo' => 'Inversiones Anthonys',
                'descripcion' => '',
                'actividad_economica' => '',
                'direccion' => '',
                'nrc' => '',
                'nit' => ''
            ]
        );
    }
}
