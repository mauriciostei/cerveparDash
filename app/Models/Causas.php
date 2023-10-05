<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Causas extends Model
{
    use HasFactory;

    public function alertas(){
        return $this->hasMany(Alertas::class);
    }
}
