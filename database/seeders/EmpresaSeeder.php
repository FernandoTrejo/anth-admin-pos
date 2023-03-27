<?php

namespace Database\Seeders;

use App\Models\CategoriaProducto;
use App\Models\Empresa;
use App\Models\Producto;
use App\Models\UsuarioPOS;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $empresa = Empresa::create(
            [
                'codigo' => '032615488848484',
                'titulo' => 'Inversiones Anthonys',
                'descripcion' => '',
                'actividad_economica' => '',
                'direccion' => '',
                'nrc' => '',
                'nit' => ''
            ]
        );

        UsuarioPOS::factory()->count(10)->create([
            'empresa_id' => $empresa->id
        ]);

        $categorias = CategoriaProducto::factory()->count(4)->create([
            'empresa_id' => $empresa->id
        ]);
        foreach($categorias as $categoria){
            Producto::factory()->count(10)->create([
                'categoria_id' => $categoria->id
            ]);
        }
    }
}
