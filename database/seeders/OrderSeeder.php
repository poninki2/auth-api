<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    public function run()
    {
        DB::table('orders')->insert([
            [
                'id_user' => 1,
                'total' => 200,
                'items' => json_encode([]),
                'status' => 'pending', // Usa un valor permitido por tu migración
                'shipping_address' => json_encode([
                    'street' => 'Calle Falsa 123',
                    'city' => 'Ciudad Ejemplo',
                    'zip' => '12345'
                ]),
                'payment_method' => 'tarjeta',
                'estimated_delivery' => '2025-07-10',
                // ...agrega aquí cualquier otra columna obligatoria según tu migración...
            ],
            // ...puedes agregar más órdenes si lo deseas...
        ]);
    }
}

