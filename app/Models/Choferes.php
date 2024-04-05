<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Choferes extends Model
{
    use HasFactory;

    public function planes(){
        return $this->belongsToMany(Planes::class, 'choferes_moviles_planes', 'choferes_id', 'planes_id')->withPivot(['viaje', 'moviles_id', 'hora_esperada', 'ayudantes_id'])->withTimestamps();
    }

    public function tiers(){
        return $this->belongsTo(Tiers::class);
    }

    public function operadoras(){
        return $this->belongsTo(Operadoras::class);
    }

    public function recorridos(){
        return $this->hasMany(Recorridos::class);
    }

    public function ayudantes(){
        return $this->belongsTo(Ayudantes::class);
    }
}
