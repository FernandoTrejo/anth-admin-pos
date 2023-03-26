<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::create(
            [
                'name' => 'Usuario #1',
                'username' => 'usuario1',
                'password' => Hash::make('clave123')
            ]

        );

        User::create(
            [
                'name' => 'Usuario #2',
                'username' => 'usuario2',
                'password' => Hash::make('clave321')
            ]
        );

        
    }
}
