<?php

namespace App\Policies;

use App\Models\Equipe;
use App\Models\User;

class EquipePolicy
{
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('equipe.view');
    }

    public function view(User $user, Equipe $equipe)
    {
        return $user->hasPermissionTo('equipe.view') || $user->id === $equipe->gestor_id;
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo('equipe.create');
    }

    public function update(User $user, Equipe $equipe)
    {
        return $user->hasPermissionTo('equipe.update') || $user->id === $equipe->gestor_id;
    }

    public function delete(User $user, Equipe $equipe)
    {
        return $user->hasPermissionTo('equipe.delete') || $user->id === $equipe->gestor_id;
    }
}
