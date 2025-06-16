<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equip>
 */
class EquipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->unique()->company,
            'titols' => $this->faker->numberBetween(0, 50),
            'estadi_id' => \App\Models\Estadi::factory(),
            'escut' => 'escuts/dummy.png', // Imatge de prova predefinida
         ];
    }
}
