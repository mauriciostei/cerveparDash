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
        return $this->belongsToMany(Moviles::class, 'choferes_moviles_planes', 'planes_id', 'moviles_id')->withPivot(['viaje', 'choferes_id', 'hora_esperada', 'ayudantes_id'])->withTimestamps()->orderByPivot('moviles.nombre');
    }

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function acuraccy(){
        $res = DB::table('acuraccy')->where('fecha', $this->fecha)->first();
        return $res->porcentaje;
    }

    public function planHistory(){
        return $this->hasMany(PlanHistory::class);
    }

    public function getAccuracyAttribute(){
        $total = 0;
        $captados = 0;

        $resulset =  DB::select("
        select cmp.choferes_id, cmp.moviles_id, cmp.viaje, count(distinct r.moviles_id) encontrado
        from planes p
            join choferes_moviles_planes cmp on p.id = cmp.planes_id
            join moviles m on m.id = cmp.moviles_id
            left join recorridos r on 
                cast(r.inicio as date) = p.fecha
                and r.moviles_id = cmp.moviles_id
                and r.choferes_id = cmp.choferes_id
                and r.viaje = cmp.viaje
        where p.id = $this->id
            and m.tiers_id = 2
        group by cmp.choferes_id, cmp.moviles_id, cmp.viaje
        ");

        foreach($resulset as $res):
            $total++;
            $captados += $res->encontrado;
        endforeach;

        if($total == 0)
            return 100;
        if($captados == 0)
            return 0;
        if($total > 0 && $captados > 0)
            return round( ($captados / $total) * 100, 0);
    }
}
