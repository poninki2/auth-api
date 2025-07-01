<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->insert([
            [
                'id_product' => 1,
                'name' => 'Producto 1',
                'description' => 'Descripción del producto 1',
                'price' => 100,
                'image' => 'producto1.jpg',
                'category' => 'General',
                // Puedes agregar los campos opcionales si lo deseas:
                // 'original_price' => null,
                // 'images' => null,
                // 'in_stock' => true,
                // 'rating' => 0,
                // 'reviews' => 0,
                // 'featured' => false,
                // 'tags' => null,
                // 'created_at' y 'updated_at' se agregan automáticamente si usas Eloquent, pero aquí puedes omitirlos
            ],
            // ...puedes agregar más productos si lo deseas...
        ]);
    }
}
