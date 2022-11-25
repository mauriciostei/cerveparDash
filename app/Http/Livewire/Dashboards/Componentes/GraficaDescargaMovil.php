<?php

namespace App\Http\Livewire\Dashboards\Componentes;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class GraficaDescargaMovil extends Component
{
    public $desde;
    public $hasta;
    public $tiers;
    public $descargaDock;
    public $descargaDock2;
    public $id_div;

    protected $listeners = ['actualizarTable'];

    public function mount($id_div){
        $this->tiers = [1,2];
        $this->id_div = $id_div;
    }

    public function actualizarTable($datos){
        $this->desde = $datos['desde'];
        $this->hasta = $datos['hasta'];
        $this->tiers = [];
        foreach($datos['tiers'] as $index => $item):
            if($item){
                array_push($this->tiers, $index);
            }
        endforeach;
    }

    public function getInfo(){

        $ini = $this->desde;
        $fin = $this->hasta;

        $descargaDock = DB::table('recorridos')
            ->select(
                'moviles.nombre'
                , DB::raw("extract(minutes from COALESCE(avg(case when recorridos.tiers_id = 1 then fin-inicio end), '00:00:00')) t1")
                , DB::raw("extract(minutes from COALESCE(avg(case when recorridos.tiers_id = 2 then fin-inicio end), '00:00:00')) t2")
                )
            ->join('moviles', 'recorridos.moviles_id', '=', 'moviles.id')
            ->where('recorridos.puntos_id', '=', env('DOCKS'))
            ->whereNotNull('fin')
            ->whereIn('recorridos.tiers_id', $this->tiers)
            ->whereDate('inicio', '>=', $ini)
            ->whereDate('inicio', '<=', $fin)
            ->groupBy('moviles.nombre')
            ->take(10)
            ->get()
        ;

        $labels = [];
        $t2 = [];
        $t1 = [];
        foreach($descargaDock as $dm){
            array_push($labels, $dm->nombre);
            array_push($t1, $dm->t1);
            array_push($t2, $dm->t2);
        }
        
        $this->descargaDock = Array('labels' => $labels, 'datasets' => [
            Array('label' => 'Tiempo Medio', 'data' => $t2, 'backgroundColor' => '#F6AB16')
        ]);

        $this->descargaDock2 = Array('labels' => $labels, 'datasets' => [
            Array('label' => 'Tiempo Medio', 'data' => $t1, 'backgroundColor' => '#37CBFF')
        ]);

        $this->emit('updateGraficoDescargaMovil', $this->descargaDock, $this->descargaDock2);
    }

    public function render(){
        $this->getInfo();
        return view('livewire.dashboards.componentes.grafica-descarga-movil');
    }
}
