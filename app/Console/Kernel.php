<?php

namespace App\Console;

use App\Http\Controllers\PlanesController;
use App\Http\Controllers\RecorridosController;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        // Clonar la planificación de ayer
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

        $schedule->call(function(){
            $r = new RecorridosController();
            $r->validarAlertas();
        })->daily();

        $schedule->call(function(){
            $r = new RecorridosController();
            
            $inicial = date('c', strtotime(now()." +3 hours -1 minute"));
            $final = date('c', strtotime("$inicial +1 minutes"));
            $r->ingresarPersona($inicial, $final);

        })->everyMinute();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
