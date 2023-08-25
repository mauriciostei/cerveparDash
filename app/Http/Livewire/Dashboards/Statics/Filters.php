<?php

namespace App\Http\Livewire\Dashboards\Statics;

use App\Models\Choferes;
use App\Models\Moviles;
use App\Models\Operadoras;
use App\Models\Puntos;
use App\Models\Tiers;
use Livewire\Component;

class Filters extends Component
{
    public $moviles;
    public $puntos;
    public $tiers;
    public $ol;
    public $choferes;
    public $estados;

    // public $selectedTiers = Array();
    // public $selectedMovil = Array();
    // public $selectedPuntos = Array();
    public $selectedEstados = Array();
    // public $selectedOL = Array();
    // public $selectedChoferes = Array();
    
    // public $selectAllTiers =  true;
    // public $selectAllMoviles =  true;
    // public $selectAllPuntos = true;
    // public $selectAllEstados = true;
    // public $selectAllOL = true;
    // public $selectAllChoferes = true;

    public function mount(){
        $this->moviles = Moviles::all();
        $this->puntos = Puntos::all();
        $this->tiers = Tiers::all();
        $this->ol = Operadoras::all();
        $this->choferes = Choferes::all();

        $this->estados = collect(
            (Object)Array('id' => 1, 'nombre' => 'OnTime'),
            (Object)Array('id' => 2, 'nombre' => 'No Tratada'),
            (Object)Array('id' => 3, 'nombre' => 'OutOfTime'),
        )->toBase();

        // foreach($this->moviles as $item){
        //     array_push($this->selectedMovil, $item->id);
        // }

        // foreach($this->puntos as $item){
        //     array_push($this->selectedPuntos, $item->id);
        // }

        // foreach($this->tiers as $item){
        //     array_push($this->selectedTiers, $item->id);
        // }

        // foreach($this->ol as $item){
        //     array_push($this->selectedOL, $item->id);
        // }

        // foreach($this->choferes as $item){
        //     array_push($this->selectedChoferes, $item->id);
        // }

        // foreach($this->estados as $item){
        //     array_push($this->selectedEstados, $item->id);
        // }

        $this->selectedEstados = Array('OnTime', 'No Tratada', 'OutOfTime');
    }

    // public function cambiarTodosPuntos(){
    //     if($this->selectAllPuntos){
    //         foreach($this->puntos as $item){
    //             array_push($this->selectedPuntos, $item->id);
    //         }
    //     }else{
    //         $this->selectedPuntos = Array();
    //     }
    //     $this->emitir();
    // }

    // public function cambiarTodosMoviles(){
    //     if($this->selectAllMoviles){
    //         foreach($this->moviles as $item){
    //             array_push($this->selectedMovil, $item->id);
    //         }
    //     }else{
    //         $this->selectedMovil = Array();
    //     }
    //     $this->emitir();
    // }

    // public function cambiarTodosEstados(){
    //     if($this->selectAllEstados){
    //         $this->selectedEstados = Array('OnTime', 'No Tratada', 'OutOfTime');
    //     }else{
    //         $this->selectedEstados = Array();
    //     }
    //     $this->emitir();
    // }

    // public function cambiarTodosTiers(){
    //     if($this->selectAllTiers){
    //         foreach($this->tiers as $item){
    //             array_push($this->selectedTiers, $item->id);
    //         }
    //     }else{
    //         $this->selectedTiers = Array();
    //     }
    //     $this->emitir();
    // }

    // public function cambiarTodosOL(){
    //     if($this->selectAllOL){
    //         foreach($this->ol as $item){
    //             array_push($this->selectedOL, $item->id);
    //         }
    //     }else{
    //         $this->selectedOL = Array();
    //     }
    //     $this->emitir();
    // }

    // public function cambiarTodosChoferes(){
    //     if($this->selectAllChoferes){
    //         foreach($this->choferes as $item){
    //             array_push($this->selectedChoferes, $item->id);
    //         }
    //     }else{
    //         $this->selectedChoferes = Array();
    //     }
    //     $this->emitir();
    // }

    // public function updated(){
    //     $this->emitir();
    // }

    // public function emitir(){
    //     $this->emit('actualizarTable', [
    //         'puntos' => $this->selectedPuntos
    //         , 'moviles' => $this->selectedMovil
    //         , 'estados' => $this->selectedEstados
    //         , 'tiers' => $this->selectedTiers
    //         , 'ol' => $this->selectedOL
    //         , 'choferes' => $this->selectedChoferes
    //     ]);
    // }

    public function render(){
        return view('livewire.dashboards.statics.filters');
    }
}
