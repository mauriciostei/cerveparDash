<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aprobables extends Model
{
    use HasFactory;

    public function perfiles(){
        return $this->belongsToMany(Perfiles::class, 'aprobables_perfiles', 'aprobables_id', 'perfiles_id');
    }
}
