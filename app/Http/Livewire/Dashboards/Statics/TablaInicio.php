<?php

namespace App\Http\Livewire\Dashboards\Statics;


use App\Models\Recorridos;
use App\Models\StoreFilter;
use App\Traits\ColorByTime;
use App\Traits\Diftime;
use App\Traits\ExportarExcel;
use App\Traits\StoreFilterGet;
use App\Traits\TimeToInt;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TablaInicio extends Component
{
    use Diftime;
    use TimeToInt;
    use ColorByTime;
    use StoreFilterGet;
    use ExportarExcel;

    public $recorridos;

    public $estadosSeleccionados;
    protected $listeners = ['actualizarInforme'];

    public function actualizarInforme(){
        $tier = $this->storeFilterGet('inicioTiers', 'tiers');
        $puntos = $this->storeFilterGet('inicioPuntos', 'puntos');
        $moviles = $this->storeFilterGet('inicioMoviles', 'moviles');
        $choferes = $this->storeFilterGet('inicioChoferes', 'choferes');

        $this->recorridos = Recorridos::
            whereDate('inicio', date('Y-m-d'))
            ->where('fin', null)
            ->orderBy('id', 'desc')
            ->whereIn('tiers_id', $tier)
            ->whereIn('puntos_id', $puntos)
            ->whereIn('moviles_id', $moviles)
            ->whereIn('choferes_id', $choferes)
            ->orderBy('id', 'desc')
        ->get();
    }

    public function mount(){
        $this->estadosSeleccionados = Array('OnTime', 'No Tratada', 'OutOfTime');
        $this->actualizarInforme();
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
        return $result ? $result->inicio : '00:00:00';
    }

    public function historial(){
        $recorridos = Recorridos::orderBy('id', 'desc')->take(10000)->get();

        $columns = array('Hora Inicio', 'Hora Fin', 'Hora Limite', 'Hora Ponderada', 'Recorrido', 'Tier', 'Movil', 'Chofer', 'Ayudante', 'Punto de control', 'Estado', 'Aplica');

        $datos = Array();
        foreach($recorridos as $m):
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

            $datos[] = Array(
                $m->inicio
                , $m->fin
                , $m->target
                , $m->ponderacion
                , $m->viaje
                , $m->tiers->nombre
                , $m->moviles ? $m->moviles->nombre : ''
                , $m->choferes ? $m->choferes->nombre : ''
                , $m->ayudantes ? $m->ayudantes->nombre : ''
                , $m->puntos->nombre
                , $m->estado
                , $aplica
            );
        endforeach;
        
        return $this->getFile('Historial.xls', $columns, $datos);
    }

    public function render()
    {
        $this->actualizarInforme();
        return view('livewire.dashboards.statics.tabla-inicio');
    }
}
