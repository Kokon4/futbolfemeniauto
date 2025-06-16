<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Estadi;

class EstadisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Estadi::create([
            'nom' => 'Camp Nou',
            'ciutat' => 'Barcelona',
            'capacitat' => 99000, 
        ]);

        Estadi::create([
            'nom' => 'Wanda Metropolitano',
            'ciutat' => 'Alcala de Henares',
            'capacitat' => 68000,
        ]);

        Estadi::create([
            'nom' => 'Santiago Bernabéu',
            'ciutat' => 'Madrid',
            'capacitat' => 81000,
        ]);
    }
}
