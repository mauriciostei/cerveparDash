<?php

namespace App\Policies;

use App\Models\Limites;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LimitesPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        // return $user->getPermisos(5)->leer;
        return $user->getPermisosByLink('limitesList')->leer;
    }

    public function view(User $user, Limites $limites)
    {
        //
    }

    public function create(User $user)
    {
        // return $user->getPermisos(5)->crear;
        return $user->getPermisosByLink('limitesList')->crear;
    }

    public function update(User $user, Limites $limites)
    {
        // return $user->getPermisos(5)->editar;
        return $user->getPermisosByLink('limitesList')->editar;
    }

    public function delete(User $user, Limites $limites)
    {
        //
    }

    public function restore(User $user, Limites $limites)
    {
        //
    }

    public function forceDelete(User $user, Limites $limites)
    {
        //
    }
}
