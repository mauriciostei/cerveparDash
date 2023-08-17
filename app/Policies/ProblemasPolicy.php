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
        return $user->getPermisos(9)->leer;
    }

    public function view(User $user, Problemas $problemas)
    {
        //
    }

    public function create(User $user)
    {
        return $user->getPermisos(9)->crear;
    }

    public function update(User $user, Problemas $problemas)
    {
        return $user->getPermisos(9)->editar;
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
