<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Choferes extends Model
{
    use HasFactory;

    public function moviles(){
        return $this->hasMany(Moviles::class);
    }

    public function planes(){
        return $this->belongsToMany(Planes::class, 'choferes_moviles_planes', 'choferes_id', 'planes_id')->withPivot(['viaje', 'moviles_id'])->withTimestamps();
    }

    public function recorridos(){
        return $this->hasMany(Recorridos::class);
    }
}