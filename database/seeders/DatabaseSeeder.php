<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Registre todos os seeders que deseja executar
        $this->call([
            UsersTableSeeder::class,
            // Adicione outros seeders aqui, se houver
        ]);
    }
}
