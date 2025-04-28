<?php

namespace Database\Factories;

use App\Models\Equipo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class JugadorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => fake()->firstNameMale() . ' ' . fake()->firstNameMale() . ' ' . fake()->lastName() . ' ' . fake()->lastName(),
            'edad' => fake()->numberBetween(16, 35),
            'posicion' => fake()->randomElement(['Delantero', 'Defensa', 'Portero', 'Mediocampo']),
            'nacionalidad' => fake()->country(),
            'numero_camiseta' => fake()->numberBetween(1, 99),
            'equipo_id' => Equipo::inRandomOrder()->first()?->id ?? Equipo::factory(),
        ];
    }

}
