<?php

namespace App\Http\Livewire\Dashboards\Statics;

use App\Models\Choferes;
use App\Models\Moviles;
use App\Models\Operadoras;
use App\Models\Puntos;
use App\Models\Recorridos;
use App\Models\Tiers;
use App\Traits\ColorByTime;
use App\Traits\Diftime;
use App\Traits\TimeToInt;
use Livewire\Component;

class TablaInicio extends Component
{
    use Diftime;
    use TimeToInt;
    use ColorByTime;

    public $recorridos;

    public $tiersSeleccionados;
    public $movilesSeleccionados;
    public $puntosSeleccionados;
    public $estadosSeleccionados;
    public $olSeleccionados;
    public $choferesSeleccionados;
    protected $listeners = ['actualizarTable'];

    public function actualizarTable($datos){
        $this->puntosSeleccionados = $datos['puntos'];
        $this->movilesSeleccionados = $datos['moviles'];
        $this->estadosSeleccionados = $datos['estados'];
        $this->tiersSeleccionados = $datos['tiers'];
        $this->olSeleccionados = $datos['ol'];
        $this->choferesSeleccionados = $datos['choferes'];
    }

    public function mount($recorridos){
        $this->recorridos = $recorridos;
        $this->puntosSeleccionados = Puntos::pluck('id')->toArray();
        $this->movilesSeleccionados = Moviles::pluck('id')->toArray();
        $this->estadosSeleccionados = Array('OnTime', 'No Tratada', 'OutOfTime');
        $this->tiersSeleccionados = Tiers::pluck('id')->toArray();
        $this->olSeleccionados = Operadoras::pluck('id')->toArray();
        $this->choferesSeleccionados = Choferes::pluck('id')->toArray();
    }

    public function getInicio($chofer, $movil, $tier){
        if($tier == 2){
            $result = Recorridos::
                whereDate('inicio', date('Y-m-d'))
                ->where('choferes_id', $chofer)
                ->orderBy('id', 'asc')
            ->first();
        }else{
            $result = Recorridos::
                whereDate('inicio', date('Y-m-d'))
                ->where('choferes_id', $chofer)
                ->where('moviles_id', $movil)
                ->orderBy('id', 'asc')
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
