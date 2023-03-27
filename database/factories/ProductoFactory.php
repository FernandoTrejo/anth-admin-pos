<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'codigo' => Str::random(10),
            'nombre' => fake()->word(),
            'precio' => fake()->numberBetween(1, 30),
            'costo' => fake()->numberBetween(1, 30),
            'imagen_url' => fake()->url(),
            'categoria_id' => 0,
            'linea_id' => null
        ];
    }
}
