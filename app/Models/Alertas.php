<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Alertas extends Model
{
    use HasFactory;

    public function recorridos(){
        return $this->belongsTo(Recorridos::class);
    }

    public function problemas(){
        return $this->belongsTo(Problemas::class);
    }

    public function soluciones(){
        return $this->belongsTo(Soluciones::class);
    }

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function tiposAlertas(){
        return $this->belongsTo(TiposAlertas::class);
    }

    public function causas(){
        return $this->belongsTo(Causas::class);
    }

    public static function totalPending(){
        $lista = null;
        $user = User::find(Auth::user()->id);
        $tipos = $user->perfiles->map->tiposAlertas->flatten()->where('activo', true)->pluck('id');
        if($tipos){
            $lista = self::where('visible', true)->whereIn('tipos_alertas_id', $tipos)->get();
        }
        return $lista;
    }

    public static function countPending(){
        $total = self::totalPending();
        $total = $total ? $total->count() : 0;
        return $total;
    }

    public function getEstado(){
        if($this->recorridos->estado == 'Dismiss' && !$this->soluciones_id){
            return 'Alerta Eliminada (Dismiss)';
        }
        if($this->recorridos->estado == 'OutOfTime' && !$this->visible && !$this->users_id && $this->fin){
            return 'Alerta Eliminada (PDC alcanzado)';
        }
        if($this->recorridos->estado == 'OutOfTime' && $this->users_id && !$this->fin){
            return 'En curso';
        }
        if($this->soluciones_id){
            return 'Resuelto';
        }
        if($this->recorridos->estado == 'OutOfTime' && !$this->fin && !$this->users_id){
            return 'Sin Asignar';
        }
    }
}
