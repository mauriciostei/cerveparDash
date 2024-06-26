<?php

namespace App\Policies;

use App\Models\Choferes;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChoferesPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        // return $user->getPermisos(5)->leer;
        return $user->getPermisosByLink('choferesList')->leer;
    }

    public function view(User $user, Choferes $choferes)
    {
        //
    }

    public function create(User $user)
    {
        // return $user->getPermisos(5)->crear;
        return $user->getPermisosByLink('choferesList')->crear;
    }

    public function update(User $user, Choferes $choferes)
    {
        // return $user->getPermisos(5)->editar;
        return $user->getPermisosByLink('choferesList')->editar;
    }

    public function delete(User $user, Choferes $choferes)
    {
        //
    }

    public function restore(User $user, Choferes $choferes)
    {
        //
    }

    public function forceDelete(User $user, Choferes $choferes)
    {
        //
    }
}
