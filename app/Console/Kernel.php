<?php

namespace App\Console;

use App\Http\Controllers\PlanesController;
use App\Http\Controllers\RecorridosController;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        // Clonar la planificacion de ayer
        $schedule->call(function(){
            $p = new PlanesController();
            $p->clonar();
        })->dailyAt('01:00');
            
        // Actualizar los recorridos OOT o DIS
        $schedule->call(function(){
            $r = new RecorridosController();
            $r->OutTime();
            $r->Dismiss();
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
