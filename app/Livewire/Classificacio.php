<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Equip;
use App\Models\Partit;

class ClassificacioTable extends Component
{
    public $classificacio = [];

    public function mount()
    {
        $this->calculateClassificacio();
    }

    public function calculateClassificacio()
    {
        $equips = Equip::all();
        $classificacio = [];

        foreach ($equips as $equip) {
            $stats = [
                'equip' => $equip,
                'punts' => 0,
                'partits_jugats' => 0,
                'partits_guanyats' => 0,
                'partits_empatats' => 0,
                'partits_perduts' => 0,
                'gols_favor' => 0,
                'gols_contra' => 0,
                'diferencia_gols' => 0,
            ];

            $partits = Partit::where('equip_local_id', $equip->id)
                ->orWhere('equip_visitant_id', $equip->id)
                ->whereNotNull('gol_local')
                ->whereNotNull('gol_visitant')
                ->get();

            foreach ($partits as $partit) {
                $stats['partits_jugats']++;

                if ($partit->equip_local_id == $equip->id) {
                    $gols_favor = $partit->gol_local;
                    $gols_contra = $partit->gol_visitant;
                } else {
                    $gols_favor = $partit->gol_visitant;
                    $gols_contra = $partit->gol_local;
                }

                $stats['gols_favor'] += $gols_favor;
                $stats['gols_contra'] += $gols_contra;

                if ($gols_favor > $gols_contra) {
                    $stats['partits_guanyats']++;
                    $stats['punts'] += 3;
                } elseif ($gols_favor == $gols_contra) {
                    $stats['partits_empatats']++;
                    $stats['punts'] += 1;
                } else {
                    $stats['partits_perduts']++;
                }
            }

            $stats['diferencia_gols'] = $stats['gols_favor'] - $stats['gols_contra'];
            $classificacio[] = $stats;
        }

        usort($classificacio, function ($a, $b) {
            if ($a['punts'] != $b['punts']) {
                return $b['punts'] - $a['punts'];
            }
            return $b['diferencia_gols'] - $a['diferencia_gols'];
        });

        $this->classificacio = $classificacio;
    }

    public function render()
    {
        return view('livewire.classificacio-table');
    }
}
