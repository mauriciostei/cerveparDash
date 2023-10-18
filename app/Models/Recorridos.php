<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recorridos extends Model
{
    use HasFactory;

    public function getHoraInicioAttribute(){
        return date('H:i:s', strtotime($this->inicio));
    }

    public function getTMAAttribute(){
        $enCurso = Recorridos::
            where('moviles_id', $this->moviles_id)
            ->where('choferes_id', $this->choferes_id)
            ->where('viaje', $this->viaje)
            ->where('tiers_id', $this->tiers_id)
            ->whereDate('inicio', date('Y-m-d', strtotime($this->inicio)))
            ->whereNull('fin')
        ->first();

        if($enCurso){
            return now();
        }

        $finReal = Recorridos::
            where('moviles_id', $this->moviles_id)
            ->where('choferes_id', $this->choferes_id)
            ->where('viaje', $this->viaje)
            ->where('tiers_id', $this->tiers_id)
            ->whereDate('inicio', date('Y-m-d', strtotime($this->inicio)))
            ->whereNotNull('fin')
            ->orderBy('fin', 'asc')
        ->first();
        return $finReal->fin;
    }

    public function moviles(){
        return $this->belongsTo(Moviles::class);
    }

    public function choferes(){
        return $this->belongsTo(Choferes::class);
    }

    public function sensores(){
        return $this->belongsTo(Sensores::class);
    }

    public function puntos(){
        return $this->belongsTo(Puntos::class);
    }

    public function tiers(){
        return $this->belongsTo(Tiers::class);
    }

    public function recorridos(){
        return $this->belongsTo(Recorridos::class);
    }
}
