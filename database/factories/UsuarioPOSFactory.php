<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UsuarioPOSFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'codigo' => Str::uuid(),
            'usuario' => fake()->userName(),
            // 'clave' => Hash::make('password123'),
            'clave' => 'password123',
            'nombre_empleado' => fake()->name(),
            'tipo_empleado' => 'cajero', //cajero, encargado, informatica
            'url_imagen' => 'https://cdn.icon-icons.com/icons2/1378/PNG/512/avatardefault_92824.png',
            'status' => 'activo'
        ];
    }
}
