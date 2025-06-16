<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\EnviarCalendariArbitres;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        EnviarCalendariArbitres::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('calendari:enviar-arbitres')
                 ->yearly()
                 ->on('1/1')
                 ->at('00:00');
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
