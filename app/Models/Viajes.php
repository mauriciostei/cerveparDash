<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Viajes extends Model
{
    use HasFactory;

    public function tiers(){
        return $this->belongsToMany(Tiers::class, 'tiers_viajes', 'viajes_id', 'tiers_id')->withPivot(['tiempo_tma']);
    }
}
