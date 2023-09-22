<?php

namespace App\Http\Livewire\Config;

use Livewire\Component;

class Dropdown extends Component
{
    public $datos;
    public $titulo;
    public $seccion;

    public $selected;

    public function mount($arreglo, $titulo){
        $this->datos = $arreglo;
        $this->titulo = $titulo;

        $this->seccion = "selected".$titulo;

        if(session($this->seccion)){
            $this->selected = session()->get($this->seccion);
        }else{
            foreach($this->datos as $s):
                $this->selected[$s['id']] = true;
            endforeach;
        }
        $this->modificacion();
    }

    public function modificacion(){
        session()->put($this->seccion, $this->selected);
        // session()->push($this->seccion, $this->selected);
        $this->emit('actualizarInforme');
    }

    public function alterar($bool){
        foreach($this->selected as $key => $item):
            $this->selected[$key] = $bool;
        endforeach;
        $this->modificacion();
    }

    public function render()
    {
        return view('livewire.config.dropdown');
    }
}
