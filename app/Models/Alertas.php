<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
