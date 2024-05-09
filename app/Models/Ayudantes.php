<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ayudantes extends Model
{
    use HasFactory;

    public function chofer(){
        return $this->hasOne(Choferes::class);
    }

    public function recorridos(){
        return $this->hasMany(Recorridos::class);
    }

    public function jornadaAyudantes(){
        return $this->hasMany(JornadaAyudantes::class);
    }

    public function planes(){
        return $this->belongsToMany(Planes::class, 'choferes_moviles_planes', 'ayudantes_id', 'planes_id')->withPivot(['viaje', 'moviles_id', 'hora_esperada', 'choferes_id'])->withTimestamps();
    }
}
