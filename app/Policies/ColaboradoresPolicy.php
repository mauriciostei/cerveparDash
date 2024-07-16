<?php

namespace App\Policies;

use App\Models\Colaboradores;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ColaboradoresPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->getPermisosByLink('colaboradoresList')->leer;
    }

    public function view(User $user, Colaboradores $colaboradores)
    {
        //
    }

    public function create(User $user)
    {
        return $user->getPermisosByLink('colaboradoresList')->crear;
    }

    public function update(User $user, Colaboradores $colaboradores)
    {
        return $user->getPermisosByLink('colaboradoresList')->editar;
    }

    public function delete(User $user, Colaboradores $colaboradores)
    {
        //
    }

    public function restore(User $user, Colaboradores $colaboradores)
    {
        //
    }

    public function forceDelete(User $user, Colaboradores $colaboradores)
    {
        //
    }
}
