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
        })->dailyAt('20:00');
            
        // Actualizar los recorridos OOT o DIS
        $schedule->call(function(){
            $r = new RecorridosController();
            $r->OutTime();
            $r->Dismiss();
            $r->alertasTMA();
        })->everyMinute();

        $schedule->call(function(){
            $r = new RecorridosController();
            $r->validarAlertas();
        })->daily();

        // Leer datos del BioStar
        $schedule->call(function(){
            $r = new RecorridosController();
            
            $inicial = date('c', strtotime(now().env('DIFF_TIME_BIOSTAR')));
            $final = date('c', strtotime("$inicial +1 minutes"));
            $r->ingresarPersona($inicial, $final);
        })->everyMinute();

        $schedule->call(function(){
            $r = new RecorridosController();

            $final = date('c', strtotime(now().env('DIFF_TIME_BIOSTAR')));
            $inicial = date('c', strtotime("$final -24 hours"));
            $r->barridoDiarioBioStar($inicial, $final);
        })->dailyAt('23:50');

        $schedule->command('logs:clear')->weekly();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
