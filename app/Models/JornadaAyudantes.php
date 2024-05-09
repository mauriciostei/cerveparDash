<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JornadaAyudantes extends Model
{
    use HasFactory;

    public function ayudantes(){
        return $this->belongsTo(Ayudantes::class);
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
}
