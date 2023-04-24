<?php

namespace Database\Seeders;

use App\Models\Vendedor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vendedor::create([
            'codigo' => '0001',
            'nombre' => 'Carlos Beltran',
            'status' => 'activo'
        ]);
        Vendedor::create([
            'codigo' => '0002',
            'nombre' => 'Miguel Asencio',
            'status' => 'activo'
        ]);
        Vendedor::create([
            'codigo' => '0003',
            'nombre' => 'Jorge Vilanova',
            'status' => 'activo'
        ]);
    }
}
