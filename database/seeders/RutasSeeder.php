<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RutasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('rutas')->insert([
            ['id' => 1, 'path' => '/api/productos', 'scope' => 'Listar productos'],
            ['id' => 2, 'path' => '/api/productos/store', 'scope' => 'Crear productos'],
            ['id' => 3, 'path' => '/api/productos/update', 'scope' => 'Actualizar productos'],
            ['id' => 4, 'path' => '/api/productos/delete', 'scope' => 'Eliminar productos']
        ]);
    }
}
