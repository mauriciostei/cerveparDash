<?php

namespace App\Http\Livewire\Limites;

use App\Models\Limites;
use App\Models\Tiers;
use Livewire\Component;

class LimitesList extends Component
{
    public $limitList;

    public $tiers;
    public $tiers_id;

    public function rules(){
        return [
            'tiers_id' => 'required',
            'limitList' => 'required|array',
            'limitList.*.lunes' => 'required|integer',
            'limitList.*.martes' => 'required|integer',
            'limitList.*.miercoles' => 'required|integer',
            'limitList.*.jueves' => 'required|integer',
            'limitList.*.viernes' => 'required|integer',
            'limitList.*.sabado' => 'required|integer',
            'limitList.*.domingo' => 'required|integer',
        ];
    }

    public function mount(){
        $this->tiers = Tiers::all();
        for ($i = 0; $i <= 23; $i++) {
            $this->updateLista($i);
        }
    }

    public function updateLista($position, $tiers_id = null, $lun = 0, $mar = 0, $mie = 0, $jue = 0, $vie = 0, $sab = 0, $dom = 0){
        $this->limitList[$position] = Array(
            'tiers_id' => $tiers_id,
            'lunes' => $lun,
            'martes' => $mar,
            'miercoles' => $mie,
            'jueves' => $jue,
            'viernes' => $vie,
            'sabado' => $sab,
            'domingo' => $dom,
        );
    }

    public function updatedTiersId(){
        foreach($this->limitList as $keyList => $list):
            $limite = Limites::where('tiers_id', $this->tiers_id)->where('rango', $keyList)->first();
            if($limite){
                $this->updateLista($keyList, $limite->tiers_id, $limite->lunes, $limite->martes, $limite->miercoles, $limite->jueves, $limite->viernes, $limite->sabado, $limite->domingo);
            }else{
                $this->updateLista($keyList, $this->tiers_id);
            }
        endforeach;
    }

    public function save(){
        $this->validate();

        foreach($this->limitList as $key => $limit):
            $limite = Limites::where('tiers_id', $this->tiers_id)->where('rango', $key)->first();
            if(!$limite){
                $limite = new Limites();
            }

            $limite->rango = $key;
            $limite->tiers_id = $limit['tiers_id'];
            $limite->lunes = $limit['lunes'];
            $limite->martes = $limit['martes'];
            $limite->miercoles = $limit['miercoles'];
            $limite->jueves = $limit['jueves'];
            $limite->viernes = $limit['viernes'];
            $limite->sabado = $limit['sabado'];
            $limite->domingo = $limit['domingo'];

            $limite->save();
        endforeach;

        session()->flash('message', 'Limites guardados!');
        return redirect()->to('/limites');
    }

    public function render()
    {
        return view('livewire.limites.limites-list');
    }
}
