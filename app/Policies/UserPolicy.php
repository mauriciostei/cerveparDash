<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;


    public function viewAny(User $user)
    {
        // return $user->getPermisos(3)->leer;
        return $user->getPermisosByLink('usuariosList')->leer;
    }

    public function view(User $user, User $model)
    {
        //
    }

    public function create(User $user)
    {
        // return $user->getPermisos(3)->crear;
        return $user->getPermisosByLink('usuariosList')->crear;
    }

    public function update(User $user, User $model)
    {
        // return $user->getPermisos(3)->editar;
        return $user->getPermisosByLink('usuariosList')->editar;
    }

    public function delete(User $user, User $model)
    {
        //
    }

    public function restore(User $user, User $model)
    {
        //
    }

    public function forceDelete(User $user, User $model)
    {
        //
    }
}
