<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfiles extends Model
{
    use HasFactory;

    public function permisos(){
        return $this->belongsToMany(Permisos::class, 'perfiles_permisos', 'perfiles_id', 'permisos_id')->withPivot(['leer', 'crear', 'editar'])->withTimestamps();
    }

    public function users(){
        return $this->belongsToMany(User::class, 'perfiles_users', 'perfiles_id', 'users_id')->withTimestamps();
    }

    public function aprobables(){
        return $this->belongsToMany(Aprobables::class, 'aprobables_perfiles', 'perfiles_id', 'aprobables_id');
    }

    public function tiposAlertas(){
        return $this->belongsToMany(TiposAlertas::class, 'perfiles_tipos_alertas', 'perfiles_id', 'tipos_alertas_id');
    }
}
