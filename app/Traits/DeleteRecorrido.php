<?php

namespace App\Traits;

use App\Models\Recorridos;
use App\Models\Alertas;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait DeleteRecorrido{

    public function deleteRecorrido($id){
        DB::transaction(function () use ($id) {
            $recorrido = Recorridos::find($id);
            if (!$recorrido) return;

            $recorrido_anterior = Recorridos::find($recorrido->recorridos_id);
            $recorrido_siguiente = Recorridos::where('recorridos_id', $id)->first();

            if($recorrido_anterior && !$recorrido_siguiente){
                $recorrido_anterior->fin = null;
                $recorrido_anterior->save();
            }

            if(!$recorrido_anterior && $recorrido_siguiente){
                $recorrido_siguiente->recorridos_id = null;
                $recorrido_siguiente->save();
            }

            if($recorrido_anterior && $recorrido_siguiente){
                $recorrido_anterior->fin = $recorrido_siguiente->inicio;
                $recorrido_anterior->save();

                $recorrido_siguiente->recorridos_id = $recorrido_anterior->id;
                $recorrido_siguiente->save();
            }

            Alertas::where('recorridos_id', $id)->delete();

            $recorrido->delete();
        });
    }
}