<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Criar permissões relacionadas às tarefas
        $permissions = [
            'equipe.view',
            'equipe.create',
            'equipe.update',
            'equipe.delete',
            'tarefa.create',
            'tarefa.edit',
            'tarefa.store',
            'tarefa.view',
            'tarefa.update',
            'tarefa.delete',
            'tarefa.concluir',
            'gerenciar.usuarios',
            'usuario.view',
            'usuario.create',
            'usuario.update',
            'usuario.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Criar papéis e associar permissões
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $gestor = Role::firstOrCreate(['name' => 'gestor']);
        $membro = Role::firstOrCreate(['name' => 'membro']);

        $admin->syncPermissions($permissions); // Admin's podem tudo
        $gestor->syncPermissions([
            'equipe.view',
            'equipe.update',
            'tarefa.create',
            'tarefa.edit',
            'tarefa.store',
            'tarefa.view',
            'tarefa.update',
            'tarefa.delete',
            'tarefa.concluir',
        ]);
        $membro->syncPermissions([
            'tarefa.view',
            'tarefa.concluir'
        ]);
    }
}
