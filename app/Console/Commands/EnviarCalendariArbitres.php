<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Mail\CalendariArbitreMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class EnviarCalendariArbitres extends Command
{
    protected $signature = 'calendari:enviar-arbitres';
    protected $description = 'Envia el calendari anual als àrbitres';

    public function handle()
    {
        $arbitres = User::where('role', 'arbitre')->get();

        foreach ($arbitres as $arbitre) {
            $partits = $arbitre->partits_arbitrats()
                ->with(['equip_local', 'equip_visitant'])
                ->orderBy('data')
                ->get();

            Mail::to($arbitre->email)->send(new CalendariArbitreMail($arbitre, $partits));
            $this->info($arbitre->name . ' ha rebut el seu calendari anual.');
        }

        $this->info('Els calendaris s\'han enviat correctament als àrbitres.');
    }
}

