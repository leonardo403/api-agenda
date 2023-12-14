<?php

namespace Database\Factories;

use App\Enums\AgendaStatusEnums;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\agenda>
 */
class AgendaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
          'user_id' => User::all()->random()->id,
          'data_inicio' => $this->faker->randomElement([$this->faker->dateTimeThisMonth()]),
          'data_prazo' => $this->faker->randomElement([$this->faker->dateTimeThisMonth()]),
          'data_conclusao' => $this->faker->randomElement([$this->faker->dateTimeThisMonth()]),
          'status' => $this->faker->randomElement([ 'aberto', 'concluido']),
          'titulo' => $this->faker->name(),
          'tipo' => $this->faker->randomElement(['normal','urgente','importante']),
          'descricao' => $this->faker->sentence(45),
          'usuario_responsavel' => User::all()->random()->name,
        ];
    }
}
