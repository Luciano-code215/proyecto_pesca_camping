<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear el usuario Administrador
        User::create([
            'name' => 'Administrador General',
            'email' => 'admin@tienda.com',
            'password' => 'admin1234',
            'rol' => 'admin',
            'active' => true,
        ]);
    }
}
