<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartItemSeeder extends Seeder
{
    public function run()
    {
        DB::table('cart_items')->insert([
            [
                'id_user' => 1,
                'id_product' => 1,
                'quantity' => 2,
                // Agrega otros campos según tu migración si es necesario
            ],
            // ...puedes agregar más items si lo deseas...
        ]);
    }
}
