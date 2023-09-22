<?php

namespace App\Http\Livewire\Config;

use App\Models\StoreFilter;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dropdown extends Component
{
    public $datos;
    public $titulo;
    public $nombre;
    public $user_id;

    public $selected;
    public $store;

    public function mount($arreglo, $nombre, $titulo){
        $this->datos = $arreglo;
        $this->titulo = $titulo;
        $this->nombre = $nombre;
        $this->user_id = Auth::user()->id;

        $this->store = StoreFilter::where('users_id', $this->user_id)->where('nombre', $this->nombre)->first();
        $datos = json_decode($this->store->datos);

        foreach($this->datos as $s):
            $this->selected[$s['id']] = in_array($s['id'], $datos);
        endforeach;
    }

    public function modificacion(){
        $result = [];
        foreach($this->selected as $key => $value):
            if($value){
                array_push($result, $key);
            }
        endforeach;
        $this->store->datos = $result;
        $this->store->save();

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
