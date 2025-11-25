<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            ['id' => 1, 'name' => 'Alimentos'],
            ['id' => 2, 'name' => 'Tecnología'],
            ['id' => 3, 'name' => 'Juguetería'],
        ]);
    }
}
