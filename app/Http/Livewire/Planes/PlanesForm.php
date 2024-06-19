<?php

namespace App\Http\Livewire\Planes;

use App\Models\Choferes;
use App\Models\Moviles;
use App\Models\Planes;
use App\Models\PlanHistory;
use App\Models\Recorridos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PlanesForm extends Component
{

    public $plan;
    public $choferes;
    public $recorridos;

    public function mount($id){
        $this->plan = Planes::find($id);
        $this->choferes = Choferes::all();
        $this->recorridos = Recorridos::whereDate('inicio', date('Y-m-d'))->get();
    }

    public function borrar($mov, $chof, $via){
        DB::table('choferes_moviles_planes')->where('planes_id', $this->plan->id)->where('moviles_id', $mov)->where('choferes_id', $chof)->where('viaje', $via)->delete();

        $this->plan->users_id = Auth::user()->id;
        $this->plan->ultima_actualizacion = now();
        $this->plan->save();

        $movil = Moviles::find($mov);

        PlanHistory::create([
            'users_id' => Auth::user()->id,
            'planes_id' => $this->plan->id,
            'tipo' => "Eliminación Manual al TIER $movil->tiers_id"
        ]);

        session()->flash('message', 'Plan eliminado!');
        return redirect()->to('/planes/'.$this->plan->id);
    }

    public function exportar(){
        $plan = $this->plan->moviles->sortByDesc('tiers_id');
        $chofer = $this->choferes;
        $recorridos = $this->recorridos;

        $fileName = 'Planificación.xls';

        $headers = array(
            "Content-type"        => "application/vnd.ms-excel;",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Expires"             => "0"
        );

        $columns = array(
            'Movil'
            , 'Chofer'
            , 'Operador Logístico'
            , 'Viaje'
            , 'Captado'
        );

        $callback = function() use($plan, $chofer, $recorridos, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns,"\t");

            foreach ($plan as $item) {
                $linea = array(
                    $item['nombre'],
                    $chofer->find($item['pivot']['choferes_id'])->nombre,
                    $chofer->find($item['pivot']['choferes_id'])->operadoras ? $chofer->find($item['pivot']['choferes_id'])->operadoras->nombre : '',
                    $item['pivot']['viaje'],
                    $recorridos->where('moviles_id', $item['id'])->first() ? 'OK' : '',
                );
                fputcsv($file, $linea,"\t");
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function render(){
        return view('livewire.planes.planes-form');
    }
}
