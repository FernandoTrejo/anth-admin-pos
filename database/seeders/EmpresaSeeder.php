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
                'codigo' => '032615488848484',
                'titulo' => 'Inversiones Anthonys',
                'descripcion' => '',
                'actividad_economica' => '',
                'direccion' => '',
                'nrc' => '',
                'nit' => ''
            ]
        );

        //creacion de usuarios pos
        UsuarioPOS::factory()->count(10)->create([
            'empresa_id' => $empresa->id
        ]);

        //creacion de categorias y productos
        $categorias = CategoriaProducto::factory()->count(4)->create([
            'empresa_id' => $empresa->id
        ]);
        foreach ($categorias as $categoria) {
            Producto::factory()->count(10)->create([
                'categoria_id' => $categoria->id
            ]);
        }

        //creacion de sucursales
        $planta = Sucursal::create([
            'codigo' => '0000000000',
            'nombre' => 'PLANTA',
            'direccion' => '',
            'telefono' => '',
            'correo' => '',
            'status' => 'activo',
            'empresa_id' => $empresa->id
        ]);
        $encuentro = Sucursal::create([
            'codigo' => '1111111111',
            'nombre' => 'SUC. EL ENCUENTRO',
            'direccion' => '',
            'telefono' => '',
            'correo' => '',
            'status' => 'activo',
            'empresa_id' => $empresa->id
        ]);
        $metrocentro = Sucursal::create([
            'codigo' => '2222222222',
            'nombre' => 'SUC. METROCENTRO',
            'direccion' => '',
            'telefono' => '',
            'correo' => '',
            'status' => 'activo',
            'empresa_id' => $empresa->id
        ]);
        

        Caja::create([
            'codigo' => '2d5f4w5f5ef5r4f5erfds5',
            'titulo' => 'Caja #1',
            'sucursal_id' => $encuentro->id
        ]);
        Caja::create([
            'codigo' => 'djsf4w5f5ef5r4f5erf1d2',
            'titulo' => 'Caja #2',
            'sucursal_id' => $metrocentro->id
        ]);

        //creacion de bodegas
        Bodega::create([
            'nombre' => 'Bodega General',
            'codigo_tienda' => '0000000000',
            'empresa_id' => $empresa->id,
            'sucursal_id' => $planta->id
        ]);
        Bodega::create([
            'nombre' => 'El Encuentro',
            'codigo_tienda' => '1111111111',
            'empresa_id' => $empresa->id,
            'sucursal_id' => $encuentro->id
        ]);
        Bodega::create([
            'nombre' => 'Metrocentro',
            'codigo_tienda' => '2222222222',
            'empresa_id' => $empresa->id,
            'sucursal_id' => $metrocentro->id
        ]);
    }
}
