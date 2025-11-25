<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('t_productos')->insert([
            [
                'nombre' => 'Arroz',
                'category_id' => 1,
                'stock' => 50,
                'precio' => 3500,
                'estado' => 'A'
            ],
            [
                'nombre' => 'Laptop Lenovo',
                'category_id' => 2,
                'stock' => 10,
                'precio' => 2500000,
                'estado' => 'A'
            ],
            [
                'nombre' => 'Carro de juguete',
                'category_id' => 3,
                'stock' => 80,
                'precio' => 30000,
                'estado' => 'A'
            ]
        ]);
    }
}
