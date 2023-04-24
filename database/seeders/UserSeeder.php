<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UsuarioPOS;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $administrador = User::create(
            [
                'name' => 'Ronald Trejo',
                'username' => 'admin',
                'password' => Hash::make('clave123')
            ]

        );

        User::create(
            [
                'name' => 'Usuario #2',
                'username' => 'usuario2',
                'password' => Hash::make('clave321'),
                'codigo_empresa' => '032615488848484'
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
        
    }
}
