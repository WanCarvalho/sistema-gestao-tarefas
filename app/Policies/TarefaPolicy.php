<?php

namespace App\Policies;

use App\Models\Tarefa;
use App\Models\User;

class TarefaPolicy
{
    public function create(User $user)
    {
        return $user->hasPermissionTo('tarefa.create');
    }

    public function view(User $user, Tarefa $tarefa)
    {
        return $user->hasPermissionTo('tarefa.view');
    }

    public function update(User $user, Tarefa $tarefa)
    {
        return $user->hasPermissionTo('tarefa.update');
    }

    public function concluir(User $user, Tarefa $tarefa)
    {
        return $user->hasPermissionTo('tarefa.concluir');
    }

    public function delete(User $user, Tarefa $tarefa)
    {
        return $user->hasPermissionTo('tarefa.delete');
    }
}
