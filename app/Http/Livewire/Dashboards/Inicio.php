<?php

namespace App\Http\Livewire\Dashboards;

use App\Models\Recorridos;
use App\Models\Tiers;
use DateTime;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Inicio extends Component
{
    public $recorridos;
    public $t1 = [];
    public $t2 = [];
    public $tiers;

    public $t1Viaje = 1;
    public $t2Viaje = 1;

    public $accuracy;
    public $accuracyLogrado;

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
        $recorridos = Recorridos::all();

        $fileName = 'Historial.xls';

        $headers = array(
            "Content-type"        => "vnd.ms-excel",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Hora Inicio', 'Hora Fin', 'Hora Limite', 'Hora Ponderada', 'Recorrido', 'Tier', 'Movil', 'Punto de control', 'Estado');

        $callback = function() use($recorridos, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns,"\t");

            foreach ($recorridos as $m) {
                $linea = array($m->inicio, $m->fin, $m->target, $m->ponderacion, $m->viaje, $m->tiers->nombre, $m->moviles->nombre, $m->puntos->nombre, $m->estado);
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

        $this->emit('accuracyGrap', $this->acuraccy[0]->porcentaje);
    }

    public function difTime($time){
        $datetime1 = new DateTime();
        $datetime2 = new DateTime($time);
        $interval = $datetime1->diff($datetime2);
        $elapsed = $interval->format('%H:%I:%S');

        return $elapsed;
    }
}
