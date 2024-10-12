<?php

namespace App\Models;

use App\Traits\AddRecorridoInMiddle;
use App\Traits\AddTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class CambiosRecorridos extends Model
{
    use HasFactory;
    use AddTime;
    use AddRecorridoInMiddle;

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

    public function aprobaciones(){
        return $this->morphOne(Aprobaciones::class, 'aprobacion');
    }

    public function rechazar(){}

    public function aprobar(){
        $chofer = Choferes::find($this->choferes_id);
        $this->addRecorrido($this->tiers_id, $this->viaje, $this->puntos_id, $this->sensores_id, $this->inicio, $this->moviles_id, $this->choferes_id, $chofer->ayudantes_id);
    }
}
