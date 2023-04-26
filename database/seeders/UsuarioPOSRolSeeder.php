<?php

namespace Database\Seeders;

use App\Models\PermisoUsuarioPOS;
use App\Models\RolUsuarioPOS;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsuarioPOSRolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //principales roles
        $informatica = RolUsuarioPOS::create(['titulo' => 'informatica']);
        $cajero = RolUsuarioPOS::create(['titulo' => 'cajero']);
        $encargado = RolUsuarioPOS::create(['titulo' => 'encargado']);

        //principales permisos
        $verDashboard = PermisoUsuarioPOS::create(['titulo' => 'ver-dashboard']);
        $verTransacciones = PermisoUsuarioPOS::create(['titulo' => 'ver-transacciones']);
        $verProductos = PermisoUsuarioPOS::create(['titulo' => 'ver-productos']);
        $verConfiguraciones = PermisoUsuarioPOS::create(['titulo' => 'ver-configuraciones']);
        $verConfiguracionesGlobales = PermisoUsuarioPOS::create(['titulo' => 'ver-configuraciones-globales']);


        //enlazar permisos a roles
        $informatica->permissions()->sync([$verDashboard->id,$verTransacciones->id,$verProductos->id,$verConfiguraciones->id,$verConfiguracionesGlobales->id]);
        $cajero->permissions()->sync([$verDashboard->id,$verProductos->id]);
        $encargado->permissions()->sync([$verDashboard->id,$verProductos->id,$verConfiguraciones->id]);
    }
}
