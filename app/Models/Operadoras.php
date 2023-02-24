<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operadoras extends Model
{
    use HasFactory;

    public function choferes(){
        return $this->hasMany(Choferes::class);
    }
}
