<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $producto1 = Producto::create(
            [
                'codigo' => 'PROD01',
                'nombre' => 'Producto #1',
                'precio' => 10,
                'costo' => 8,
                'imagen_url' => ''
            ]
        );

        $producto2 = Producto::create(
            [
                'codigo' => 'PROD02',
                'nombre' => 'Producto #2',
                'precio' => 20,
                'costo' => 16,
                'imagen_url' => ''
            ]
        );

        $producto3 = Producto::create(
            [
                'codigo' => 'PROD03',
                'nombre' => 'Producto #3',
                'precio' => 14.253,
                'costo' => 10.2323,
                'imagen_url' => ''
            ]
        );
    }
}
