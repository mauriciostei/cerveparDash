<?php

namespace App\Http\Livewire\Dashboards\Statics;


use App\Models\Recorridos;
use App\Traits\ColorByTime;
use App\Traits\Diftime;
use App\Traits\SessionArrayFilter;
use App\Traits\TimeToInt;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class TablaInicio extends Component
{
    use Diftime;
    use TimeToInt;
    use ColorByTime;
    use SessionArrayFilter;

    public $recorridos;

    public $tiersSeleccionados;
    public $movilesSeleccionados;
    public $puntosSeleccionados;
    public $estadosSeleccionados;
    public $olSeleccionados;
    public $choferesSeleccionados;
    protected $listeners = ['actualizarInforme'];

    public function actualizarInforme(){
        $tier = $this->sessionToArray('selectedTiers');
        $puntos = $this->sessionToArray('selectedSitio');
        $moviles = $this->sessionToArray('selectedMóviles');
        $choferes = $this->sessionToArray('selectedChofer');

        $this->recorridos = Recorridos::
            whereDate('inicio', date('Y-m-d'))
            ->where('fin', null)
            ->orderBy('id', 'desc')
            ->whereIn('tiers_id', $tier)
            ->whereIn('puntos_id', $puntos)
            ->whereIn('moviles_id', $moviles)
            ->whereIn('choferes_id', $choferes)
        ->get();
    }

    public function mount($recorridos){
        $this->recorridos = $recorridos;
        $this->estadosSeleccionados = Array('OnTime', 'No Tratada', 'OutOfTime');
    }

    public function getInicio($chofer, $movil, $tier, $viaje){
        if($tier == 2){
            $result = Recorridos::
                whereDate('inicio', date('Y-m-d'))
                ->where('choferes_id', $chofer)
                // ->where('viaje', $viaje)
                ->orderBy('inicio', 'asc')
            ->first();
        }else{
            $result = Recorridos::
                whereDate('inicio', date('Y-m-d'))
                ->where('choferes_id', $chofer)
                ->where('moviles_id', $movil)
                ->where('viaje', $viaje)
                ->orderBy('inicio', 'asc')
            ->first();
        }
        return $result->inicio;
    }

    public function historial(){
        $recorridos = Recorridos::orderBy('id', 'desc')->take(10000)->get();

        $fileName = 'Historial.xls';

        $headers = array(
            "Content-type"        => "application/vnd.ms-excel;",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            //"Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array(
            'Hora Inicio'
            , 'Hora Fin'
            , 'Hora Limite'
            , 'Hora Ponderada'
            , 'Recorrido'
            , 'Tier'
            , 'Movil'
            , 'Chofer'
            , 'Punto de control'
            , 'Estado'
            , 'Aplica'
        );

        $callback = function() use($recorridos, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns,"\t");

            foreach ($recorridos as $m) {

                //Evalúa el tiempo en función a los puntos de control
                $aplica = 'SI';
                if($m->fin){
                    $tiempo = strtotime($m->fin) - strtotime($m->inicio);
                    $min = $this->timeToInt($m->puntos->minimo);
                    $max = $this->timeToInt($m->puntos->maximo);
                    if($tiempo <= $min || $tiempo >= $max){
                        $aplica = 'NO';
                    }
                }

                $linea = array(
                    $m->inicio
                    , $m->fin
                    , $m->target
                    , $m->ponderacion
                    , $m->viaje
                    , $m->tiers->nombre
                    , $m->moviles ? $m->moviles->nombre : ''
                    , $m->choferes ? $m->choferes->nombre : ''
                    , $m->puntos->nombre
                    , $m->estado
                    , $aplica
                );
                fputcsv($file, $linea,"\t");
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function render()
    {
        return view('livewire.dashboards.statics.tabla-inicio');
    }
}
