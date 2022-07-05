<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planes extends Model
{
    use HasFactory;

    public function choferes(){
        return $this->belongsToMany(Choferes::class, 'choferes_moviles_planes', 'planes_id', 'choferes_id')->withPivot(['viaje', 'moviles_id'])->withTimestamps();
    }

    public function moviles(){
        return $this->belongsToMany(Moviles::class, 'choferes_moviles_planes', 'planes_id', 'moviles_id')->withPivot(['viaje', 'choferes_id'])->withTimestamps();
    }
}
