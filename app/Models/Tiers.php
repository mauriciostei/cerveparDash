<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiers extends Model
{
    use HasFactory;

    public function recorridos(){
        return $this->hasMany(Recorridos::class);
    }

    public function moviles(){
        return $this->hasMany(Moviles::class);
    }

    public function choferes(){
        return $this->hasMany(Choferes::class);
    }

    public function hours(){
        return $this->hasMany(TiersHours::class);
    }

    public function puntos(){
        return $this->belongsToMany(Puntos::class, 'puntos_tiers', 'tiers_id', 'puntos_id')->withPivot(['viaje', 'orden', 'target', 'ponderacion'])->withTimestamps()->orderByPivot('orden');
    }

    public function viajes(){
        return $this->belongsToMany(Viajes::class, 'tiers_viajes', 'tiers_id', 'viajes_id')->withPivot(['tiempo_tma']);
    }

    public function jornadaAyudantes(){
        return $this->hasMany(JornadaAyudantes::class);
    }
}
