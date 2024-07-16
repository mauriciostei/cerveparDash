<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permisos extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','link', 'categoria', 'icono', 'orden'];

    public function perfiles(){
        return $this->belongsToMany(Perfiles::class, 'perfiles_permisos', 'permisos_id', 'perfiles_id')->withPivot(['leer', 'crear', 'editar'])->withTimestamps();
    }
}
