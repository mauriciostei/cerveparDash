<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Problemas extends Model
{
    use HasFactory;

    public function soluciones(){
        return $this->belongsToMany(Soluciones::class, 'problemas_soluciones', 'problemas_id', 'soluciones_id')->withTimestamps();
    }

    public function alertas(){
        return $this->hasMany(Alertas::class);
    }
}
