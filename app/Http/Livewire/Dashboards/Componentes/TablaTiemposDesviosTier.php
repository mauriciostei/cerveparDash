<?php

namespace App\Http\Livewire\Dashboards\Componentes;

use App\Models\Recorridos;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TablaTiemposDesviosTier extends Component
{
    public $desde;
    public $hasta;
    public $tiers;

    public $resumenPuntos;

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

    public function getPorcentaje($oot, $cantidad){
        $valor = 0;
        if($cantidad > 0 && $oot > 0){
            $valor = ($oot / $cantidad) * 100;
        }
        $valor = round($valor , 0);

        return $valor;
    }

    public function getHTML($oot, $cantidad){
        $valor = $this->getPorcentaje($oot, $cantidad);

        $color = '';

        if($valor > 50)
            $color = 'bg-red';
        if($valor <= 50 && $valor > 25)
            $color = 'bg-warning';
        if($valor <= 25 && $valor > 10)
            $color = 'bg-yellow';
        if($valor <= 10)
            $color = 'bg-success';

        $res = "<td><div class='".$color."'><div class='text-center text-dark'>".$valor."% </div></div></td>";

        echo $res;
    }

    public function getInfo(){

        $ini = $this->desde;
        $fin = $this->hasta;

        $this->resumenPuntos = Recorridos::
            select(
                'puntos.nombre'
                , DB::raw("sum(case when tiers_id = 1 then 1 else 0 end) as cantidad_t1")
                , DB::raw("sum(case when tiers_id = 1 and estado = 'OutOfTime' then 1 else 0 end) oot_t1")
                , DB::raw("sum(case when tiers_id = 2 then 1 else 0 end) as cantidad_t2")
                , DB::raw("sum(case when tiers_id = 2 and estado = 'OutOfTime' then 1 else 0 end) oot_t2")
                )
            ->join('puntos', 'recorridos.puntos_id', '=', 'puntos.id')
            ->whereIn('recorridos.tiers_id', $this->tiers)
            ->whereDate('inicio', '>=', $ini)
            ->whereDate('inicio', '<=', $fin)
            ->groupBy('puntos.nombre')
            ->get()
        ;
    }

    public function render(){
        $this->getInfo();
        return view('livewire.dashboards.componentes.tabla-tiempos-desvios-tier');
    }
}
