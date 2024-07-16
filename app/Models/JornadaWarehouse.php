<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JornadaWarehouse extends Model
{
    use HasFactory;

    public function colaboradores(){
        return $this->belongsTo(Colaboradores::class);
    }

    public function sensores(){
        return $this->belongsTo(Sensores::class);
    }

    public function puntos(){
        return $this->belongsTo(Puntos::class);
    }
}
