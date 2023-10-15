<?php

namespace App\Policies;

use App\Models\Moviles;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MovilesPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        // return $user->getPermisos(6)->leer;
        return $user->getPermisosByLink('movilesList')->leer;
    }

    public function view(User $user, Moviles $moviles)
    {
        //
    }

    public function create(User $user)
    {
        // return $user->getPermisos(6)->crear;
        return $user->getPermisosByLink('movilesList')->crear;
    }

    public function update(User $user, Moviles $moviles)
    {
        // return $user->getPermisos(6)->editar;
        return $user->getPermisosByLink('movilesList')->editar;
    }

    public function delete(User $user, Moviles $moviles)
    {
        //
    }

    public function restore(User $user, Moviles $moviles)
    {
        //
    }

    public function forceDelete(User $user, Moviles $moviles)
    {
        //
    }
}
