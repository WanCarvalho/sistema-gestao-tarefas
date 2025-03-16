<?php

namespace Database\Factories;

use App\Enums\PrioridadeTarefaEnum;
use App\Enums\StatusTarefaEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tarefa>
 */
class TarefaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Buscar um usuário com a role 'admin' ou 'gestor'
        $user = User::whereHas('roles', function($query) {
            $query->whereIn('name', ['admin', 'gestor']);
        })->inRandomOrder()->first();

        return [
            'user_id' => $user ? $user->id : User::first()->id,
            'responsavel_id' => $user ? $user->id : User::first()->id,
            'status' => StatusTarefaEnum::EM_ANDAMENTO,
            'titulo' => fake()->text(20),
            'descricao' => fake()->text(50),
            'prioridade' => fake()->randomElement([
                PrioridadeTarefaEnum::BAIXA,
                PrioridadeTarefaEnum::MEDIA,
                PrioridadeTarefaEnum::ALTA
            ]),
            'prazo_final' => fake()->dateTimeBetween('now', '+1 month'),
        ];
    }
}
