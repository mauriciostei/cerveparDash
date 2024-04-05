<?php

namespace App\Policies;

use App\Models\Ayudantes;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AyudantesPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->getPermisosByLink('ayudantesList')->leer;
    }

    public function view(User $user, Ayudantes $ayudantes)
    {
        //
    }

    public function create(User $user)
    {
        return $user->getPermisosByLink('ayudantesList')->crear;
    }

    public function update(User $user, Ayudantes $ayudantes)
    {
        return $user->getPermisosByLink('ayudantesList')->editar;
    }

    public function delete(User $user, Ayudantes $ayudantes)
    {
        //
    }

    public function restore(User $user, Ayudantes $ayudantes)
    {
        //
    }

    public function forceDelete(User $user, Ayudantes $ayudantes)
    {
        //
    }
}
