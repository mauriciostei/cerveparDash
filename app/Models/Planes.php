<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Planes extends Model
{
    use HasFactory;

    public function choferes(){
        return $this->belongsToMany(Choferes::class, 'choferes_moviles_planes', 'planes_id', 'choferes_id')->withPivot(['viaje', 'moviles_id', 'hora_esperada'])->withTimestamps();
    }

    public function moviles(){
        return $this->belongsToMany(Moviles::class, 'choferes_moviles_planes', 'planes_id', 'moviles_id')->withPivot(['viaje', 'choferes_id', 'hora_esperada'])->withTimestamps()->orderByPivot('moviles.nombre');
    }

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function acuraccy(){
        $res = DB::table('acuraccy')->where('fecha', $this->fecha)->first();
        return $res->porcentaje;
    }
}
