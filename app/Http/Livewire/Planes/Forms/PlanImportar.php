<?php

namespace App\Http\Livewire\Planes\Forms;

use App\Models\Choferes;
use App\Models\Moviles;
use App\Models\Planes;
use App\Models\Tiers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;

class PlanImportar extends Component
{
    use WithFileUploads;

    public $plan;

    // Form para importar
    public $file;
    public $remplazar = false;

    protected $rules = [
        'file' => 'required|file|max:10240',
        'remplazar' => '',
    ];

    public function mount($id){
        $this->plan = Planes::find($id);
    }

    public function subirArchivo(){
        $fecha = date('Y-m.d');
        $file = $this->file->storeAs('/planes', 'plan'.$fecha.'.txt', $disk = 'local');
        $file = '../storage/app/'.$file;
        
        $fh = fopen($file, 'r');
        $contenido = explode("\n", fread($fh, filesize($file)));
        fclose($fh);

        foreach($contenido as $m):
            $line = explode("\t", $m);

            $tiers = Tiers::find($line[0] ?? null);
            $codigo = trim($line[1] ?? null);
            $chapa = trim($line[2] ?? null);
            $viaje = trim($line[3] ?? null);
            $documento = trim($line[4] ?? null);

            if(!$tiers || !$codigo || !$chapa || !$viaje || !$documento || $viaje > 2){
                throw ValidationException::withMessages([ 'file' => 'Archivo con datos vacíos o datos inválidos' ]);
            }else{
                
            }
        endforeach;


        if($this->remplazar){
            DB::table('choferes_moviles_planes')->where('planes_id', $this->plan->id)->delete();
        }

        foreach($contenido as $m):
            $line = explode("\t", $m);

            $tier = trim($line[0]);
            $codigo = trim($line[1]);
            $chapa = trim($line[2]);
            $viaje = trim($line[3]);
            $documento = trim($line[4]);

            $movil = Moviles::where('chapa', $chapa)->first();
            if(!$movil){
                $movil = new Moviles();
                $movil->nombre = $codigo;
                $movil->chapa = $chapa;
                $movil->tiers_id = $tier;
                $movil->save();
            }

            $chofer = Choferes::where('documento', $documento)->first();
            if(!$chofer){
                $chofer = Choferes::find(1);
            }

            $yaPlanificado = DB::table('choferes_moviles_planes')
                ->where('planes_id', $this->plan->id)
                ->where('moviles_id', $movil->id)
                ->where('choferes_id', $chofer->id)
                ->where('viaje', $viaje)
            ->first();

            $validate = DB::table('choferes_moviles_planes')->where('planes_id', $this->plan->id)->where('moviles_id', $movil->id)->where('viaje', $viaje)->first();
            if($validate){
                continue;
            }

            if($chofer->tiers_id == 2){
                $validate = DB::table('choferes_moviles_planes')->where('planes_id', $this->plan->id)->where('choferes_id', $chofer->id)->where('viaje', $viaje)->first();
                if($validate){
                    continue;
                }
            }

            if(!$yaPlanificado){
                $this->plan->moviles()->attach($movil->id, ['choferes_id' => $chofer->id, 'viaje' => $viaje]);
            }

        endforeach;

        $this->plan->users_id = Auth::user()->id;
        $this->plan->ultima_actualizacion = now();
        $this->plan->save();

        session()->flash('message', 'Plan Actualizado!');
        return redirect()->to('/planes/'.$this->plan->id);
    }

    public function render()
    {
        return view('livewire.planes.forms.plan-importar');
    }
}
