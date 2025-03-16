<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Executa o seeder de permissões primeiro
        $this->call([
            PermissionsSeeder::class,
            UserSeeder::class,
            TarefaSeeder::class,
        ]);
    }
}
