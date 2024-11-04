<?php

namespace App\Observers;

use App\Models\Limites;
use App\Models\Planes;
use App\Models\Recorridos;
use Illuminate\Support\Facades\DB;

class RecorridosObserver
{
    public function created(Recorridos $recorridos)
    {
        //Obtiene la fecha y hora para la ejecución
        $inicio = $recorridos->inicio;
        $hoy = date('Y-m-d');
        $hora = date('H', strtotime($inicio));
        
        //Si supera los 55 minutos se pasa a la siguiente hora
        $hora += !(date('i', strtotime($inicio)) < 55) && 1;

        //Obtiene el dia esperado para la verificación
        $dias = array('lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo');
        $dia = $dias[date('N', strtotime($inicio)) - 1];

        //Obtiene el total de móviles esperados en ese dia y ese horario
        $total = Limites::where('tiers_id', $recorridos->tiers_id)->where('rango', $hora)->first();
        $total = $total ? $total->$dia : 0;

        //Lista de móviles detectados en la franca horaria que coincidan con el tier del Movil establecido
        $reco = DB::select(
            DB::raw("select moviles_id, choferes_id, viaje, min(inicio) as inicio
            from recorridos
            where cast(inicio as date) = '$hoy'
                and tiers_id = $recorridos->tiers_id
            group by moviles_id, choferes_id, viaje
            having extract(hour from min(inicio)) = $hora
            order by min(inicio) asc")
        );

        //Obtiene la planificación del dia
        $plan = Planes::where('fecha', $hoy)->first();

        //Actualiza el estado del plan para saver si el Movil debía o no pasar en ese horario (ya es un móvil saturado o no)
        foreach($reco as $r):
            $corresponde = $total>0 ? true : false;

            DB::table('choferes_moviles_planes')
                ->where('planes_id', $plan->id)
                ->where('moviles_id', $r->moviles_id)
                ->where('choferes_id', $r->choferes_id)
                ->where('viaje', $r->viaje)
                ->where('corresponde', true)
                ->update(['corresponde' => $corresponde])
            ;

            $total--;
        endforeach;
    }

    public function updated(Recorridos $recorridos)
    {
        //
    }

    public function deleted(Recorridos $recorridos)
    {
        //
    }

    public function restored(Recorridos $recorridos)
    {
        //
    }

    public function forceDeleted(Recorridos $recorridos)
    {
        //
    }
}
