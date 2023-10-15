<?php

namespace App\Policies;

use App\Models\Problemas;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProblemasPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        // return $user->getPermisos(9)->leer;
        return $user->getPermisosByLink('problemasList')->leer;
    }

    public function view(User $user, Problemas $problemas)
    {
        //
    }

    public function create(User $user)
    {
        // return $user->getPermisos(9)->crear;
        return $user->getPermisosByLink('problemasList')->crear;
    }

    public function update(User $user, Problemas $problemas)
    {
        // return $user->getPermisos(9)->editar;
        return $user->getPermisosByLink('problemasList')->editar;
    }

    public function delete(User $user, Problemas $problemas)
    {
        //
    }

    public function restore(User $user, Problemas $problemas)
    {
        //
    }

    public function forceDelete(User $user, Problemas $problemas)
    {
        //
    }
}
