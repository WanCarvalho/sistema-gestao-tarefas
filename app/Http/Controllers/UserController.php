<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        Gate::authorize('usuario.view');

        $usuarios = User::paginate(10);

        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        Gate::authorize('usuario.create');

        $roles = Role::all();

        return view('usuarios.create', [
            'roles' => $roles,
        ]);
    }

    public function store(Request $request)
    {
        Gate::authorize('usuario.create');

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Atribuir o role ao usuário
        $user->assignRole($request->role);

        return redirect()->route('usuarios.index')->with('success', 'Usuário criado com sucesso!');
    }

    public function edit(User $user)
    {
        Gate::authorize('usuario.update');

        $roles = Role::all();

        return view('usuarios.edit', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    public function update(Request $request, User $user)
    {
        Gate::authorize('usuario.update');

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'role' => 'required|exists:roles,name',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
        ]);

        // Atualizar o role do usuário
        $user->syncRoles($request->role);

        return redirect()->route('usuarios.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    public function destroy(User $user)
    {
        Gate::authorize('usuario.delete');
        $user->delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuário excluído com sucesso!');
    }
}
