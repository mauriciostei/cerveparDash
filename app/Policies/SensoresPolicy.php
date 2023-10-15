<?php

namespace App\Policies;

use App\Models\Sensores;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SensoresPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        // return $user->getPermisos(7)->leer;
        return $user->getPermisosByLink('sensoresList')->leer;
    }

    public function view(User $user, Sensores $sensores)
    {
        //
    }

    public function create(User $user)
    {
        // return $user->getPermisos(7)->crear;
        return $user->getPermisosByLink('sensoresList')->crear;
    }

    public function update(User $user, Sensores $sensores)
    {
        // return $user->getPermisos(7)->editar;
        return $user->getPermisosByLink('sensoresList')->editar;
    }

    public function delete(User $user, Sensores $sensores)
    {
        //
    }

    public function restore(User $user, Sensores $sensores)
    {
        //
    }

    public function forceDelete(User $user, Sensores $sensores)
    {
        //
    }
}
