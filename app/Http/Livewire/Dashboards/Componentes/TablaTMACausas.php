<?php

namespace App\Http\Livewire\Dashboards\Componentes;

use App\Traits\TimeToHour;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TablaTMACausas extends Component
{
    use TimeToHour;

    public $desde;
    public $hasta;
    public $tiers;

    protected $listeners = ['actualizarTable'];

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

    public function render()
    {
        $alertas = DB::select(DB::raw("
        select c.nombre causa_nombre
            , count(*) cantidad
            , avg(ru.fin - ri.inicio) tiempo_medio
        from alertas a
            join recorridos ri on a.recorridos_id = ri.id
            join recorridos ru on ru.tiers_id = ri.tiers_id 
                and ru.moviles_id = ri.moviles_id
                and ru.choferes_id = ri.choferes_id
                and ru.viaje = ri.viaje
                and cast(ru.inicio as date) = cast(ri.inicio as date)
                and ru.fin is not null
                and ru.inicio = ru.fin
            join causas c on a.causas_id = c.id
        where a.tipos_alertas_id = 2
            and cast(a.created_at as date) between '$this->desde' and '$this->hasta'
        group by c.nombre;
        "));

        return view('livewire.dashboards.componentes.tabla-t-m-a-causas', [
            'alertas' => $alertas
        ]);
    }
}
