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
        select c.nombre as causa_nombre
            , count(*) as cantidad
            , avg( COALESCE(
                (
                    select fin 
                    from recorridos 
                    where 
                        cast(inicio as date) = cast(r.inicio as date) 
                        and moviles_id = r.moviles_id 
                        and choferes_id = r.choferes_id 
                        and viaje = r.viaje 
                        and tiers_id = r.tiers_id 
                        and fin is not null
                        limit 1
                ),current_timestamp) - r.inicio
            ) as tiempo_medio
        from alertas a
            join recorridos r on r.id = a.recorridos_id
            left join causas c on c.id = a.causas_id 
        where a.tipos_alertas_id = 2
            and cast(a.created_at as date) between '$this->desde' and '$this->hasta'
        group by c.nombre;
        "));

        return view('livewire.dashboards.componentes.tabla-t-m-a-causas', [
            'alertas' => $alertas
        ]);
    }
}
