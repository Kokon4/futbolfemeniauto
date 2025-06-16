<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Equip;
use App\Models\Partit;
use App\Models\Estadi;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PartitFactory extends Factory
{
    protected $model = Partit::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $equipLocal = Equip::query()->inRandomOrder()->first();
        $equipVisitant = Equip::query()->where('id', '!=', $equipLocal->id)->inRandomOrder()->first();

        return [
            'equip_local_id' => $equipLocal->id,
            'equip_visitant_id' => $equipVisitant->id,
            'estadi_id' => $equipLocal->estadi->id,
            'arbitre_id' => User::query()->where('role', 'arbitre')->inRandomOrder()->first()->id,
            'data' => $this->faker->dateTimeBetween('2022-01-01', '2023-12-31'),
            'resultat' => $this->faker->numberBetween(0,10) . ' - ' . $this->faker->numberBetween(0,10),
            'gol_local' => $this->faker->numberBetween(0,10),
            'gol_visitant' => $this->faker->numberBetween(0,10),
        ];
    }
}
