<?php

namespace App\Policies;

use App\Models\Puntos;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PuntosPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->getPermisos(11)->leer;
    }

    public function view(User $user, Puntos $puntos)
    {
        //
    }

    public function create(User $user)
    {
        return $user->getPermisos(11)->crear;
    }

    public function update(User $user, Puntos $puntos)
    {
        return $user->getPermisos(11)->editar;
    }

    public function delete(User $user, Puntos $puntos)
    {
        //
    }

    public function restore(User $user, Puntos $puntos)
    {
        //
    }

    public function forceDelete(User $user, Puntos $puntos)
    {
        //
    }
}
