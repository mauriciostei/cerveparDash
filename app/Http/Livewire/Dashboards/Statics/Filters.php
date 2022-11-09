<?php

namespace App\Http\Livewire\Dashboards\Statics;

use App\Models\Moviles;
use App\Models\Puntos;
use App\Models\Tiers;
use Livewire\Component;

class Filters extends Component
{
    public $moviles;
    public $puntos;
    public $tiers;

    public $selectedTiers = Array();
    public $selectedMovil = Array();
    public $selectedPuntos = Array();
    public $selectedEstados = Array();
    
    public $selectAllTiers =  true;
    public $selectAllMoviles =  true;
    public $selectAllPuntos = true;
    public $selectAllEstados = true;

    public function mount(){
        $this->moviles = Moviles::all();
        $this->puntos = Puntos::all();
        $this->tiers = Tiers::all();

        foreach($this->moviles as $item){
            array_push($this->selectedMovil, $item->id);
        }

        foreach($this->puntos as $item){
            array_push($this->selectedPuntos, $item->id);
        }

        foreach($this->tiers as $item){
            array_push($this->selectedTiers, $item->id);
        }

        $this->selectedEstados = Array('OnTime', 'Dismiss', 'OutOfTime');
    }

    public function cambiarTodosPuntos(){
        if($this->selectAllPuntos){
            foreach($this->puntos as $item){
                array_push($this->selectedPuntos, $item->id);
            }
        }else{
            $this->selectedPuntos = Array();
        }
        $this->emitir();
    }

    public function cambiarTodosMoviles(){
        if($this->selectAllMoviles){
            foreach($this->moviles as $item){
                array_push($this->selectedMovil, $item->id);
            }
        }else{
            $this->selectedMovil = Array();
        }
        $this->emitir();
    }

    public function cambiarTodosEstados(){
        if($this->selectAllEstados){
            $this->selectedEstados = Array('OnTime', 'Dismiss', 'OutOfTime');
        }else{
            $this->selectedEstados = Array();
        }
        $this->emitir();
    }

    public function cambiarTodosTiers(){
        if($this->selectAllTiers){
            foreach($this->tiers as $item){
                array_push($this->selectedTiers, $item->id);
            }
        }else{
            $this->selectedTiers = Array();
        }
        $this->emitir();
    }

    public function updated(){
        $this->emitir();
    }

    public function emitir(){
        $this->emit('actualizarTable', ['puntos' => $this->selectedPuntos, 'moviles' => $this->selectedMovil, 'estados' => $this->selectedEstados, 'tiers' => $this->selectedTiers]);
    }

    public function render(){
        return view('livewire.dashboards.statics.filters');
    }
}
