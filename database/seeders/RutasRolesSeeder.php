<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RutasRolesSeeder extends Seeder
{
    public function run(): void
    {
        // Admin puede todo
        DB::table('ruta_role')->insert([
            ['role_id' => 1, 'ruta_id' => 1],
            ['role_id' => 1, 'ruta_id' => 2],
            ['role_id' => 1, 'ruta_id' => 3],
            ['role_id' => 1, 'ruta_id' => 4],
        ]);

        // User solo listar
        DB::table('ruta_role')->insert([
            ['role_id' => 2, 'ruta_id' => 1],
        ]);
    }
}
