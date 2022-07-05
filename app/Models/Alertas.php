<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alertas extends Model
{
    use HasFactory;

    public function recorridos(){
        return $this->belongsTo(Recorridos::class);
    }

    public function problemas(){
        return $this->belongsTo(Problemas::class);
    }

    public function soluciones(){
        return $this->belongsTo(Soluciones::class);
    }

    public function users(){
        return $this->belongsTo(User::class);
    }
}
