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
        return [
            'user_id' => User::inRandomOrder()->first()->id,
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
