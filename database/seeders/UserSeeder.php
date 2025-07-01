<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'id_person' => 1, // Asegúrate de que exista la persona con id 1
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'id_rol' => 1, // Asegúrate de que exista el rol con id 1 (admin)
        ]);
        // Puedes añadir más usuarios aquí si lo deseas
    }
}
