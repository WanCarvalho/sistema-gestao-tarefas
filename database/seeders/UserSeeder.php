<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
