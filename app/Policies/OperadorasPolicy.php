<?php

namespace App\Policies;

use App\Models\Operadoras;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OperadorasPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        // return $user->getPermisos(16)->leer;
        return $user->getPermisosByLink('operadorasList')->leer;
    }

    public function view(User $user, Operadoras $operadoras)
    {
        //
    }

    public function create(User $user)
    {
        // return $user->getPermisos(16)->crear;
        return $user->getPermisosByLink('operadorasList')->crear;
    }

    public function update(User $user, Operadoras $operadoras)
    {
        // return $user->getPermisos(16)->editar;
        return $user->getPermisosByLink('operadorasList')->editar;
    }

    public function delete(User $user, Operadoras $operadoras)
    {
        //
    }

    public function restore(User $user, Operadoras $operadoras)
    {
        //
    }

    public function forceDelete(User $user, Operadoras $operadoras)
    {
        //
    }
}
