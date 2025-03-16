<?php

namespace Database\Seeders;

use App\Models\Equipe;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EquipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Criar algumas equipes
        $equipes = [
            'Equipe A',
            'Equipe B',
            'Equipe C',
        ];

        foreach ($equipes as $nome) {
            $equipe = Equipe::create(['nome' => $nome]);

            // Associar membros (gestor e membro) a cada equipe
            // Associando 1 gestor e 3 membros aleatórios a cada equipe

            // Associar 1 gestor
            $gestor = User::whereHas('roles', function ($query) {
                $query->where('name', 'gestor');
            })->inRandomOrder()->first();
            if ($gestor) {
                $equipe->gestores()->attach($gestor->id, ['role' => 'gestor']);
            }

            // Associar 3 membros
            $membros = User::whereHas('roles', function ($query) {
                $query->where('name', 'membro');
            })->inRandomOrder()->take(3)->get();

            foreach ($membros as $membro) {
                $equipe->membros()->attach($membro->id);
            }
        }
    }
}
