<?php

namespace App\Http\Livewire\Recorridos;

use App\Models\CambiosRecorridos;
use App\Models\Choferes;
use App\Models\Moviles;
use App\Models\Recorridos;
use App\Models\Sensores;
use App\Models\Tiers;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Cambios extends Component
{
    public $moviles;
    public $choferes;
    public $tiers;
    public $puntos;
    public $sensores;
    public $fecha;

    public $cambio;
    public $recorridos;
    public $ideal;
    public $hora;

    public $observacion;

    public function rules(){
        return [
            'cambio.viaje' => 'required|integer',
            'cambio.moviles_id' => 'required|exists:moviles,id',
            'cambio.choferes_id' => 'required|exists:choferes,id',
            'cambio.tiers_id' => 'required|exists:tiers,id',
            'cambio.puntos_id' => 'required|exists:puntos,id',
            'cambio.sensores_id' => 'required|exists:sensores,id',
            'cambio.inicio' => 'required',
            'cambio.observacion' => 'required',
            'fecha' => 'required',
            'hora' => 'required',
        ];
    }

    public function mount(){
        $this->moviles = Moviles::all();
        $this->choferes = Choferes::all();
        $this->tiers = Tiers::all();
        $this->fecha = date('Y-m-d');

        $this->cambio = new CambiosRecorridos();
        $this->cambio->viaje = 1;

        $this->listaMoviles();
        $this->cambio->tiers_id = $this->moviles->first()->tiers_id;
    }

    public function listaMoviles(){
        $this->moviles = Moviles::whereIn('id', 
            DB::table('planes')
                ->select('choferes_moviles_planes.moviles_id')
                ->join('choferes_moviles_planes', 'planes.id', 'choferes_moviles_planes.planes_id')
                ->whereDate('fecha', $this->fecha)
                ->where('choferes_moviles_planes.viaje', $this->cambio->viaje)
        )->get();
    }

    public function listaChoferes(){
        $this->choferes = Choferes::whereIn('id', 
            DB::table('planes')
                ->select('choferes_moviles_planes.choferes_id')
                ->join('choferes_moviles_planes', 'planes.id', 'choferes_moviles_planes.planes_id')
                ->whereDate('fecha', $this->fecha)
                ->where('choferes_moviles_planes.moviles_id', $this->cambio->moviles_id)
                ->where('choferes_moviles_planes.viaje', $this->cambio->viaje)
        )->get();
    }

    public function anular(){
        $this->cambio->choferes_id = null;
        $this->cambio->moviles_id = null;
        $this->listaMoviles();
    }

    public function updatedFecha($value){
        $this->actualizarIdeal();
        $this->anular();
    }

    public function updatedHora($value){
        $this->cambio->inicio = "$this->fecha $value";
    }

    public function updatedCambioMovilesId($value){
        $this->cambio->tiers_id = Moviles::find($value)->tiers_id;
        $this->actualizarIdeal();
        $this->listaChoferes();
    }

    public function updatedCambioChoferesId($value){
        $this->actualizarIdeal();
    }

    public function updatedCambioViaje($value){
        $this->actualizarIdeal();
        $this->anular();
    }

    public function actualizarIdeal(){
        $this->ideal = Tiers::find($this->cambio->tiers_id);
    }

    public function getRecorrido($punto){
        $recorrido = Recorridos::
            whereDate('inicio', $this->fecha)
            ->where('tiers_id', $this->cambio->tiers_id)
            ->where('moviles_id', $this->cambio->moviles_id)
            ->where('choferes_id', $this->cambio->choferes_id)
            ->where('viaje', $this->cambio->viaje)
            ->where('puntos_id', $punto)
            ->first()
        ;

        if($recorrido){
            $recorrido->moviles;
            $recorrido->choferes;
            $recorrido->sensores;
        }

        return $recorrido;
    }

    public function chosePunto($punto){
        $this->cambio->puntos_id = $punto;
        $this->cambio->sensores_id = null;
        $this->sensores = Sensores::where('puntos_id', $punto)->get();
    }

    public function solicitudEnCurso($punto){
        $cambio = CambiosRecorridos::
            whereDate('inicio', $this->fecha)
            ->where('tiers_id', $this->cambio->tiers_id)
            ->where('moviles_id', $this->cambio->moviles_id)
            ->where('choferes_id', $this->cambio->choferes_id)
            ->where('viaje', $this->cambio->viaje)
            ->where('puntos_id', $punto)
            ->first()
        ;

        if($cambio){
            return $cambio->aprobaciones->estado == 1;
        }

        return false;
    }

    public function save(){
        $this->validate();

        $this->cambio->inicio = "$this->fecha $this->hora";
        $this->cambio->save();

        session()->flash('message', 'Solicitud registrada!');

        return redirect()->to('/inicio');
    }

    public function render(){
        return view('livewire.recorridos.cambios');
    }
}
