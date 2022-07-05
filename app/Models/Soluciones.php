<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soluciones extends Model
{
    use HasFactory;

    public function problemas(){
        return $this->belongsToMany(Problemas::class, 'problemas_soluciones', 'soluciones_id', 'problemas_id')->withTimestamps();
    }

    public function alertas(){
        return $this->hasMany(Alertas::class);
    }
}
