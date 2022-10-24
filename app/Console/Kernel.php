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
            
            $seconds = 5;
            $count = (60/$seconds) - 2;
            $inicial = date('c', strtotime(date('Y-m-d H:i:s').' +3 hours'));
            do{
                $final = date('c', strtotime("$inicial +5 seconds"));
                $r->ingresarPersona($inicial, $final);

                $count--;
                $inicial = $final;
                sleep($seconds);
            }while($count != 0);

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
