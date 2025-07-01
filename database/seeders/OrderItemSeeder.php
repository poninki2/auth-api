<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderItemSeeder extends Seeder
{
    public function run()
    {
        DB::table('order_items')->insert([
            [
                'id_order' => 1,
                'id_product' => 1,
                'quantity' => 2,
                'price' => 100,
                // Agrega otros campos según tu migración si es necesario
            ],
            // ...puedes agregar más items si lo deseas...
        ]);
    }
}
