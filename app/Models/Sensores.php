<?php

namespace App\Models;

use App\Enums\TipoSentidoSensor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensores extends Model
{
    use HasFactory;

    protected $cast = [
        'direccion' => TipoSentidoSensor::class
    ];

    public function puntos(){
        return $this->belongsTo(Puntos::class);
    }

    public function recorridos(){
        return $this->hasMany(Recorridos::class);
    }
}
