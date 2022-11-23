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

    protected $listeners = ['actualizarTable'];

    public function mount(){
        $this->tiers = [1,2];
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
                , DB::raw("extract(minutes from COALESCE(avg(fin-inicio), '00:00:00')) tiempo")
                )
            ->join('moviles', 'recorridos.moviles_id', '=', 'moviles.id')
            ->where('recorridos.puntos_id', '=', env('DOCKS'))
            ->whereNotNull('fin')
            ->whereIn('recorridos.tiers_id', $this->tiers)
            ->whereDate('inicio', '>=', $ini)
            ->whereDate('inicio', '<=', $fin)
            ->groupBy('moviles.nombre')
            ->orderByRaw('tiempo desc')
            ->take(10)
            ->get()
        ;

        $labels = [];
        $t2 = [];
        foreach($descargaDock as $dm){
            array_push($labels, $dm->nombre);
            array_push($t2, $dm->tiempo);
        }
        $this->descargaDock = Array('labels' => $labels, 'datasets' => [
            Array('label' => 'Tiempo Medio', 'data' => $t2, 'backgroundColor' => '#F6AB16')
        ]);

        $max = $t2 ? max($t2) : 0;

        $this->emit('updateGraficoDescargaMovil', $this->descargaDock, $max);
    }

    public function render(){
        $this->getInfo();
        return view('livewire.dashboards.componentes.grafica-descarga-movil');
    }
}
