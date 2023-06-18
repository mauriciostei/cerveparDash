<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Aprobaciones extends Model
{
    use HasFactory;

    public function aprobacion(){
        return $this->morphTo();
    }

    public function users(){
        return $this->belongsTo(User::class);
    }

    public static function totalPending(){
        $lista = null;
        $user = User::find(Auth::user()->id);
        $apr = $user->perfiles->map->aprobables->flatten()->where('activo', true)->pluck('aprobable_type');
        if($apr){
            $lista = self::where('estado', 1)->whereIn('aprobacion_type', $apr)->get();
        }
        return $lista;
    }

    public function getTipoAttribute(){
        $split = explode('\\', $this->aprobacion_type);
        return end($split);
    }

    public function getVistaAttribute(){
        $resultado = "";
        $tipos = preg_split('![^A-Z]+!', $this->tipo);
        array_pop($tipos);
        array_shift($tipos);
        foreach($tipos as $t):
            $resultado = str_replace($t, "-$t", $this->tipo);
        endforeach;
        return strtolower($resultado);
    }

    public static function countPending(){
        $total = self::totalPending();
        $total = $total ? $total->count() : 0;
        return $total;
    }
}
