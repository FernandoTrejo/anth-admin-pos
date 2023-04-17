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

        //creacion de usuarios pos
        UsuarioPOS::factory()->count(1)->create([
            'codigo' => '72b1b156-fb7e-4aa0-a509-03dce841cb50',
            'usuario' => 'admin',
            'clave' => 'adminpass',
            'nombre_empleado' => 'Administrador',
            'tipo_empleado' => 'informatica',
        ]);
        UsuarioPOS::factory()->count(3)->create([
            'tipo_empleado' => 'encargado'
        ]);
        UsuarioPOS::factory()->count(10)->create();

        //creacion de sucursales
        $planta = Sucursal::create([
            'codigo' => '69ed8ad3-1138-40a9-ba36-89d9c2882359',
            'nombre' => 'PLANTA',
            'direccion' => '',
            'telefono' => '',
            'correo' => '',
            'status' => 'activo'
        ]);
        $encuentro = Sucursal::create([
            'codigo' => '50c1bb68-2e10-49f3-80a6-82fc548a6d17',
            'nombre' => 'SUC. EL ENCUENTRO',
            'direccion' => '',
            'telefono' => '',
            'correo' => '',
            'status' => 'activo'
        ]);
        $metrocentro = Sucursal::create([
            'codigo' => '5eef59fe-d911-4b9d-8984-b0584ea09a10',
            'nombre' => 'SUC. METROCENTRO',
            'direccion' => '',
            'telefono' => '',
            'correo' => '',
            'status' => 'activo'
        ]);
        

        Caja::create([
            'codigo' => '56ccbec0-6bf3-4507-9aad-3a80ed6e651e',
            'titulo' => 'Caja #1',
            'sucursal_id' => $encuentro->id
        ]);
        Caja::create([
            'codigo' => '275fd84d-9a5b-4e01-b1fe-09111295163c',
            'titulo' => 'Caja #2',
            'sucursal_id' => $metrocentro->id
        ]);

        //creacion de bodegas
        Bodega::create([
            'nombre' => 'Bodega General',
            'codigo_tienda' => '0000000000',
            'sucursal_id' => $planta->id
        ]);
        Bodega::create([
            'nombre' => 'El Encuentro',
            'codigo_tienda' => '1111111111',
            'sucursal_id' => $encuentro->id
        ]);
        Bodega::create([
            'nombre' => 'Metrocentro',
            'codigo_tienda' => '2222222222',
            'sucursal_id' => $metrocentro->id
        ]);
    }
}
