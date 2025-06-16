<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\EnviarCalendariArbitres::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // Run the command on January 1st at 00:00
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

