<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categorias')->insert([
            ['id' => 1, 'nombre' => 'Pesca', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nombre' => 'Camping', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'nombre' => 'Indumentaria', 'created_at' => now(), 'updated_at' => now()]
        ]);


    }
}
