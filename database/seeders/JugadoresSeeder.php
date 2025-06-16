<?php

namespace Database\Seeders;

use App\Models\Jugadora;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Equip;
use Illuminate\Support\Facades\Storage;
class JugadoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Assegurem-nos que el directori d'emmagatzematge existeix
        Storage::makeDirectory('public/jugadores');

        // Obtenim tots els equips
        $equips = Equip::all();

        foreach ($equips as $equip) {
            // Creem 9 jugadores per cada equip
            Jugadora::factory(9)->create([
                'equip_id' => $equip->id,
            ]);
        }

        // Afegim algunes jugadores addicionals aleatòriament
        Jugadora::factory(20)->create();
    }
}
