<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->delete();
        DB::table('roles')->insert([
            ['id_rol' => 1, 'name' => 'admin'],
            ['id_rol' => 2, 'name' => 'cliente'],
            // ...agrega más roles si lo deseas...
        ]);
    }
}
