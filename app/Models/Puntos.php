<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puntos extends Model
{
    use HasFactory;

    public function sensors(){
        return $this->hasMany(Sensores::class);
    }

    public function tiers(){
        return $this->belongsToMany(Tiers::class, 'puntos_tiers', 'puntos_id', 'tiers_id')->withPivot(['viaje', 'orden', 'target', 'ponderacion'])->withTimestamps();
    }

    public function recorridos(){
        return $this->hasMany(Recorridos::class);
    }
}
