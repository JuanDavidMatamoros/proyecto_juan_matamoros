<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EquipoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->company . ' FC',
            'categoria' => $this->faker->randomElement(['Infantil', 'Juvenil', 'Libre', 'Veteranos']),
            'ciudad' => $this->faker->city,
            'fundado_en' => $this->faker->year('1970', '2020'),
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'propietario_id' => User::inRandomOrder()->first()->id ?? User::factory(),
        ];
    }

}
