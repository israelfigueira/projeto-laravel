<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exemplo>
 */
class ExemploFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->word(),
            'quantidade' => (int) $this->faker->numberBetween(0, 9999),
            'dt_exemplo' => $this->faker->date(),
            'valor_real' => $this->faker->randomFloat(),
        ];
    }
}
