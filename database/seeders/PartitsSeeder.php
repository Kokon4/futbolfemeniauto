<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Partit;
use Exception;
use App\Models\User;
use App\Models\Equip;
use Carbon\Carbon;

class PartitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arbitres = User::where('role', 'arbitre')->get();

        if ($arbitres->isEmpty()) {
            throw new Exception('No hi ha cap arbitre disponible');
        }

        $equips = Equip::all();
        $numEquips = $equips->count();

        if ($numEquips % 2 !== 0 || $numEquips < 2) {
            throw new Exception('No hi ha suficients equips per crear partits');
        }

        $numJornades = $numEquips - 1;
        $partitsPerJornada = $numEquips / 2;
        $dataInicial = Carbon::create(2024, 9, 7);
        $dataLimitResultats = Carbon::create(2024, 12, 15);
        $arbitres = $arbitres->shuffle();

        //Generem el calendari d'anada

        $jornaes = [];

        for ($jornada = 1; $jornada <= $numJornades; $jornada++) {
            $dataJornada = $dataInicial->copy()->addWeeks($jornada - 1);
            $jornades[$jornada] = [];

            $equipsActuals = $equips->toArray();
            $localEquips = array_slice($equipsActuals, 0, $partitsPerJornada);
            $visitantEquips = array_slice($equipsActuals, $partitsPerJornada);

            for ($i = 0; $i < $partitsPerJornada; $i++) {
                $local = $localEquips[$i];
                $visitant = $visitantEquips[$i];

                if ($jornada % 2 === 0) {
                    $temp = $local;
                    $local = $visitant;
                    $visitant = $temp;
                }
                $dataAleatoria = $dataJornada->copy()->addDays(rand(-2, 2));
                $partit = Partit::create([
                    'equip_local_id' => $local['id'],
                    'equip_visitant_id' => $visitant['id'],
                    'estadi_id' => $local['estadi_id'],
                    'arbitre_id' => $arbitres->first()->id,
                    'jornada' => $jornada,
                    'data' => $dataAleatoria,
                    'resultat' => '0-0',
                    'gol_local' => $dataAleatoria < $dataLimitResultats ? rand(0, 5) : null,
                    'gol_visitant' => $dataAleatoria < $dataLimitResultats ? rand(0, 5) : null,
                ]);
                $jornades[$jornada][] = $partit;
            }
            $equips->push($equips->splice(1,1)[0]);
        }

        foreach ($jornades as $jornada => $partits) {
            $dataJornadaTornada = $dataInicial->copy()->addWeeks($numJornades + $jornada - 1);

            foreach($partits as $partit) {
                $dataAleatoria = $dataJornadaTornada->copy()->addDay(rand(-2,2));
                Partit::create([
                    'equip_local_id' => $partit->equip_visitant_id,
                    'equip_visitant_id' => $partit->equip_local_id,
                    'estadi_id' => $partit->equip_visitant_id ? Equip::find($partit->equip_visitant_id)->estadi_id : null,
                    'arbitre_id' => $arbitres->random()->id,
                    'jornada' => $jornada + $numJornades,
                    'data' => $dataAleatoria,
                    'resultat' => '0-0',
                    'gol_local' => $dataAleatoria < $dataLimitResultats ? rand(0, 5) : null,
                    'gol_visitant' => $dataAleatoria < $dataLimitResultats ? rand(0, 5) : null,
                ]);
            }

        // foreach (range(1, 38) as $jornada) {
        //     Partit::factory()
        //         ->count(9)
        //         ->create([
        //             'jornada' => $jornada,
        //         ]);
        // }
        }
}
}