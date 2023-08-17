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
        return $user->getPermisos(6)->leer;
    }

    public function view(User $user, Moviles $moviles)
    {
        //
    }

    public function create(User $user)
    {
        return $user->getPermisos(6)->crear;
    }

    public function update(User $user, Moviles $moviles)
    {
        return $user->getPermisos(6)->editar;
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
