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
