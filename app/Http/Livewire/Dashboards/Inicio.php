<?php

namespace App\Http\Livewire\Dashboards;

use App\Models\Moviles;
use App\Models\Puntos;
use App\Models\Recorridos;
use App\Models\Tiers;
use App\Traits\TimeToInt;
use DateTime;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Inicio extends Component
{
    use TimeToInt;

    public $recorridos;
    public $t1 = [];
    public $t2 = [];
    public $tiers;

    public $t1Viaje = 1;
    public $t2Viaje = 1;

    public $acuraccy;
    public $accuracyLogrado;

    public $tiersSeleccionados;
    public $movilesSeleccionados;
    public $puntosSeleccionados;
    public $estadosSeleccionados;
    protected $listeners = ['actualizarTable'];

    public function actualizarTable($datos){
        $this->puntosSeleccionados = $datos['puntos'];
        $this->movilesSeleccionados = $datos['moviles'];
        $this->estadosSeleccionados = $datos['estados'];
        $this->tiersSeleccionados = $datos['tiers'];
    }

    public function mount(){
        $this->puntosSeleccionados = Puntos::pluck('id')->toArray();
        $this->movilesSeleccionados = Moviles::pluck('id')->toArray();
        $this->estadosSeleccionados = Array('OnTime', 'No Tratada', 'OutOfTime');
        $this->tiersSeleccionados = Tiers::pluck('id')->toArray();
    }

    public function render()
    {
        $this->getInfo();
        return view('livewire.dashboards.inicio');
    }

    public function cambiarViaje($tier){
        if($tier == 1){
            $this->t1Viaje = ($this->t1Viaje == 1) ? 2 : 1;
        }else{
            $this->t2Viaje = ($this->t2Viaje == 1) ? 2 : 1;
        }
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

    public function getInfo(){
        $this->recorridos = Recorridos::
            where('created_at', '>=', date('Y-m-d').' 00:00:00')
            ->where('fin', null)
            ->orderBy('id', 'desc')
        ->get();

        $this->tiers = Tiers::all();

        $this->t1['OnTime'] = $this->recorridos->where('tiers_id', 1)->where('estado', 'OnTime')->count();
        $this->t1['OutOfTime'] = $this->recorridos->where('tiers_id', 1)->where('estado', 'OutOfTime')->count();
        $this->t1['total'] = $this->t1['OnTime'] + $this->t1['OutOfTime'];
        $this->t1['%'] = $this->t1['OnTime']==0 ? 0 : round(($this->t1['OnTime'] / $this->t1['total']) * 100, 0);

        $this->t2['OnTime'] = $this->recorridos->where('tiers_id', 2)->where('estado', 'OnTime')->count();
        $this->t2['OutOfTime'] = $this->recorridos->where('tiers_id', 2)->where('estado', 'OutOfTime')->count();
        $this->t2['total'] = $this->t2['OnTime'] + $this->t2['OutOfTime'];
        $this->t2['%'] = $this->t2['OnTime']==0 ? 0 : round(($this->t2['OnTime'] / $this->t2['total']) * 100, 0);

        $this->acuraccy = DB::table('acuraccy')->whereDate('fecha', date('Y-m-d'))->get();
    }

    public function difTime($time){
        $datetime1 = new DateTime();
        $datetime2 = new DateTime($time);
        $interval = $datetime1->diff($datetime2);
        $elapsed = $interval->format('%H:%I:%S');

        return $elapsed;
    }
}
