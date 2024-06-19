<?php

namespace App\Http\Livewire\Planes\Forms;

use App\Models\Choferes;
use App\Models\Moviles;
use App\Models\Planes;
use App\Models\PlanHistory;
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
    public $tiers;

    // Form para importar
    public $file;
    public $remplazar = false;
    public $tier;

    protected $rules = [
        'file' => 'required|file|max:10240',
        'remplazar' => '',
        'tier' => 'required',
    ];

    public function mount($id){
        $this->plan = Planes::find($id);
        $this->tiers = Tiers::all();
    }

    public function subirArchivo(){
        $this->validate();

        $fecha = date('Y-m-d');
        $file = $this->file->storeAs('/planes', "plan(T{$this->tier})".$fecha.'.txt', $disk = 'local');
        $file = '../storage/app/'.$file;
        
        $fh = fopen($file, 'r');
        $contenido = explode("\n", fread($fh, filesize($file)));
        fclose($fh);

        foreach($contenido as $m):
            $line = explode("\t", $m);

            $tier = trim($line[0]) ?? null;
            $codigo = trim($line[1] ?? null);
            $chapa = trim($line[2] ?? null);
            $viaje = trim($line[3] ?? null);
            $documento = trim($line[4] ?? null);
            $hora = ($tier == 1) ? trim($line[5] ?? null) : null;

            if($this->tier==2 && (!$tier || !$codigo || !$chapa || !$viaje || !$documento || $viaje > 2)){
                throw ValidationException::withMessages([ 'file' => 'Archivo con datos vacíos o datos inválidos' ]);
            }
            if($this->tier==1 && (!$tier || !$codigo || !$chapa || !$viaje || !$documento || $viaje > 2 || !$hora)){
                throw ValidationException::withMessages([ 'file' => 'Archivo con datos vacíos o datos inválidos' ]);
            }
        endforeach;


        if($this->remplazar){
            $choferes_delete = DB::table('choferes')->where('tiers_id', $this->tier)->select('id');
            DB::table('choferes_moviles_planes')->where('planes_id', $this->plan->id)->whereIn('choferes_id', $choferes_delete)->delete();

            $moviles_delete = DB::table('moviles')->where('tiers_id', $this->tier)->select('id');
            DB::table('choferes_moviles_planes')->where('planes_id', $this->plan->id)->whereIn('moviles_id', $moviles_delete)->delete();
        }

        foreach($contenido as $m):
            $line = explode("\t", $m);

            $tier = trim($line[0]);
            $codigo = trim($line[1]);
            $chapa = trim($line[2]);
            $viaje = trim($line[3]);
            $documento = trim($line[4]);
            $hora = ($tier == 1) ? trim($line[5] ?? null) : null;

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
                $this->plan->moviles()->attach($movil->id, ['choferes_id' => $chofer->id, 'viaje' => $viaje, 'hora_esperada' => $hora, 'ayudantes_id' => $chofer->ayudantes_id]);
            }

        endforeach;

        $this->plan->users_id = Auth::user()->id;
        $this->plan->ultima_actualizacion = now();
        $this->plan->save();

        PlanHistory::create([
            'users_id' => Auth::user()->id,
            'planes_id' => $this->plan->id,
            'tipo' => 'Importación de archivo'
        ]);

        session()->flash('message', 'Plan Actualizado!');
        return redirect()->to('/planes/'.$this->plan->id);
    }

    public function render()
    {
        return view('livewire.planes.forms.plan-importar');
    }
}
