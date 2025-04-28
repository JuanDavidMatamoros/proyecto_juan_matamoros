<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crea el usuario fijo primero (y evita duplicado)
        \App\Models\User::firstOrCreate(
            ['email' => 'test@example.com'],
            ['name' => 'Admin', 'password' => bcrypt('password')]
        );

        // Luego genera 10 usuarios aleatorios con correos únicos
        \App\Models\User::factory(10)->create();

        // Llama al seeder de equipos
        $this->call([
            EquiposTableSeeder::class,
            JugadoresTableSeeder::class
        ]);
    }

}
