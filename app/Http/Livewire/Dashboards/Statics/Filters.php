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

    public $selectedEstados = Array();

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

        $this->selectedEstados = Array('OnTime', 'No Tratada', 'OutOfTime');
    }

    public function render(){
        return view('livewire.dashboards.statics.filters');
    }
}
