<?php

namespace App\Http\Livewire\Recorridos;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Traits\DeleteRecorrido;

class Binnacle extends Component
{
    use DeleteRecorrido;

    public $busqueda;
    public $fecha;
    public $tiers;
    public $recorridos;

    public function eliminarRecorrido($id){
        $this->deleteRecorrido($id);
    }

    public function mount(){
        $this->fecha = date('d-m-Y');

        $tier = request()->routeIs('binnacleT1') ? 1 : 2;
        $this->tiers = [$tier];
    }

    public function getInfo(){
        $this->recorridos = DB::table('recorridos')->select([
            'recorridos.id as id'
            , 'moviles.nombre as movil_nombre'
            , 'moviles.chapa as movil_chapa'
            , 'choferes.nombre as choferes_nombre'
            , 'choferes.documento as choferes_documento'
            , 'puntos.nombre as puntos_nombre'
            , 'sensores.nombre as sensores_nombre'
            , 'recorridos.inicio'
            , 'recorridos.fin'
        ])
            ->join('puntos', 'recorridos.puntos_id', '=', 'puntos.id')
            ->join('sensores', 'recorridos.sensores_id', '=', 'sensores.id')
            ->join('choferes', 'choferes.id', '=', 'recorridos.choferes_id')
            ->join('moviles', 'moviles.id', '=', 'recorridos.moviles_id')
            ->whereDate('recorridos.inicio', $this->fecha)
            ->whereIn('recorridos.tiers_id', $this->tiers)
            ->when($this->busqueda, function($query) {
                $busqueda = '%' . $this->busqueda . '%';
                $query->where(function($q) use ($busqueda) {
                    $q->where('choferes.nombre', 'like', $busqueda)
                        ->orWhere('choferes.documento', 'like', $busqueda)
                        ->orWhere('moviles.nombre', 'like', $busqueda)
                        ->orWhere('moviles.chapa', 'like', $busqueda);
                });
            })
            ->orderByRaw('2,4,8 asc')
            ->get()
        ;
    }

    public function render(){
        $this->getInfo();
        return view('livewire.recorridos.binnacle');
    }
}
