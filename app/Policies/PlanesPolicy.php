<?php

namespace App\Policies;

use App\Models\Planes;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlanesPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->getPermisos(8)->leer;
    }

    public function view(User $user, Planes $planes)
    {
        //
    }

    public function create(User $user)
    {
        return $user->getPermisos(8)->crear;
    }

    public function update(User $user, Planes $planes)
    {
        return $user->getPermisos(8)->editar;
    }

    public function delete(User $user, Planes $planes)
    {
        //
    }

    public function restore(User $user, Planes $planes)
    {
        //
    }

    public function forceDelete(User $user, Planes $planes)
    {
        //
    }
}
