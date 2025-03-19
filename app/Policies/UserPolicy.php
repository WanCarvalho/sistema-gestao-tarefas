<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function view(User $user)
    {
        return $user->hasPermissionTo('usuario.view');
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo('usuario.create');
    }

    public function update(User $user, User $targetUser)
    {
        return $user->hasPermissionTo('usuario.update') || $user->id === $targetUser->id;
    }

    public function delete(User $user, User $targetUser)
    {
        return $user->hasPermissionTo('usuario.delete') && !$targetUser->hasRole('admin');
    }
}
