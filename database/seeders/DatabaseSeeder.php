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
        ]);

        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
        ]);

        $gestor = User::factory()->create([
            'name' => 'Gestor',
            'email' => 'gestor@gestor.com',
        ]);

        $membro = User::factory()->create([
            'name' => 'Membro',
            'email' => 'membro@membro.com',
        ]);

        $admin->assignRole('admin');
        $gestor->assignRole('gestor');
        $membro->assignRole('membro');
    }
}
