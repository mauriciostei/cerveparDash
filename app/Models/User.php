<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function alertas(){
        return $this->hasMany(Alertas::class);
    }

    public function planes(){
        return $this->hasMany(Planes::class);
    }

    public function aprobaciones(){
        return $this->hasMany(Aprobaciones::class);
    }

    public function perfiles(){
        return $this->belongsToMany(Perfiles::class, 'perfiles_users', 'users_id', 'perfiles_id')->withTimestamps();
    }

    public function planHistory(){
        return $this->hasMany(PlanHistory::class);
    }

    public function getPermisos($permisos_id){
        return DB::table('roles')->where('users_id', $this->id)->where('permisos_id', $permisos_id)->first();
    }

    public function getPermisosByLink($permiso){
        return DB::table('roles')->where('users_id', $this->id)->where('link', $permiso)->first();
    }
}
