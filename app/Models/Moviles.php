<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moviles extends Model
{
    use HasFactory;

    public function planes(){
        return $this->belongsToMany(Planes::class, 'choferes_moviles_planes', 'moviles_id', 'planes_id')->withPivot(['viaje', 'choferes_id'])->withTimestamps();
    }

    public function tiers(){
        return $this->belongsTo(Tiers::class);
    }

    public function recorridos(){
        return $this->hasMany(Recorridos::class);
    }
}
