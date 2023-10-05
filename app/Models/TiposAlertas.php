<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiposAlertas extends Model
{
    use HasFactory;

    public function alertas(){
        return $this->hasMany(Alertas::class);
    }

    public function perfiles(){
        return $this->belongsToMany(Perfiles::class, 'perfiles_tipos_alertas', 'tipos_alertas_id', 'perfiles_id');
    }
}
