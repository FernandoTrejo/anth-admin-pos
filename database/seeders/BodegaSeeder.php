<?php

namespace Database\Seeders;

use App\Models\Bodega;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BodegaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bodega1 = Bodega::create([
            'nombre' => 'Bodega Principal',
            'codigo_tienda' => Str::uuid()
        ]);

        $bodega2 = Bodega::create([
            'nombre' => 'Bodega Suc. 01',
            'codigo_tienda' => Str::uuid()
        ]);

        $bodega3 = Bodega::create([
            'nombre' => 'Bodega Suc. 03',
            'codigo_tienda' => Str::uuid()
        ]);
    }
}
