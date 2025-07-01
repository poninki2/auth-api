<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonSeeder extends Seeder
{
    public function run()
    {
        DB::table('personas')->insert([
            [
                'id_person' => 1,
                'first_name' => 'Juan',
                'last_name' => 'Pérez',
                // Puedes agregar los campos opcionales si lo deseas:
                // 'avatar' => null,
                // 'address' => 'Calle Falsa 123',
                // 'phone' => '123456789',
            ],
            // ...puedes agregar más personas si lo deseas...
        ]);
    }
}
