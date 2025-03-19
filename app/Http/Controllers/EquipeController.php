<?php

namespace App\Http\Controllers;

use App\Http\Requests\EquipeRequest;
use App\Models\Equipe;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class EquipeController extends Controller
{
    public function index()
    {
        try {
            Gate::authorize('equipe.view');

            $user = User::find(Auth::id());

            // Se o usuário for admin, retorna todas as equipes
            if ($user->hasRole('admin')) {
                $equipes = Equipe::query()->paginate(9);
            } else {
                // Caso contrário, retorna apenas as equipes onde ele é gestor
                $equipes = $user->equipes()->wherePivot('role', 'gestor')->paginate(10);
            }

            return view('equipes.index', [
                'equipes' => $equipes,
            ]);
        } catch (Exception $e) {
            return back()->with('error', 'Erro ao carregar as equipes: ' . $e->getMessage());
        }
    }


    public function show(Equipe $equipe)
    {
        try {
            Gate::authorize('equipe.view');

            // Buscar todos os membros
            $membros = $equipe->membros()->wherePivot('role', 'membro')->get();

            // Buscar todos os gestores
            $gestores = $equipe->gestores()->wherePivot('role', 'gestor')->get();

            return view('equipes.show', [
                'equipe' => $equipe,
                'membros' => $membros,
                'gestores' => $gestores,
            ]);
        } catch (Exception $e) {
            return back()->with('error', 'Erro ao carregar a equipe: ' . $e->getMessage());
        }
    }

    public function create()
    {
        Gate::authorize('equipe.create');

        return view('equipes.create');
    }

    public function store(EquipeRequest $request)
    {
        try {
            Gate::authorize('equipe.create');

            $equipe = Equipe::create($request->validated());

            // Adiciona o usuário autenticado como gestor da equipe
            $equipe->membros()->attach(Auth::id(), ['role' => 'gestor']);

            return redirect()->route('equipes.index')->with('success', 'Equipe criada com sucesso!');
        } catch (Exception $e) {
            return back()->with('error', '' . $e->getMessage());
        }
    }

    public function update(EquipeRequest $request, Equipe $equipe)
    {
        try {
            Gate::authorize('equipe.update');

            $equipe->update($request->validated());

            return redirect()->route('equipes.index')->with('success', 'Equipe atualizada com sucesso!');
        } catch (Exception $e) {
            return back()->with('error', '' . $e->getMessage());
        }
    }

    public function edit()
    {
        try {
            Gate::authorize('equipe.update');

            return view('equipes.edit', compact('equipe'));
        } catch (Exception $e) {
            return back()->with('error', '' . $e->getMessage());
        }
    }

    public function delete(Equipe $equipe)
    {
        try {
            Gate::authorize('equipe.delete');

            $equipe->delete();

            return redirect()->route('equipes.index')->with('success', 'Equipe excluída com sucesso!');
        } catch (Exception $e) {
            return back()->with('error', '' . $e->getMessage());
        }
    }

    // Exibir o formulário para adicionar membro
    public function createMembro(Equipe $equipe)
    {
        Gate::authorize('equipe.update');

        $usuarios = User::all(); // Buscar todos os usuários disponíveis

        return view('equipes.membros.create', compact('equipe', 'usuarios'));
    }

    // Salvar novo membro na equipe
    public function storeMembro(Request $request, Equipe $equipe)
    {
        Gate::authorize('equipe.update');

        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $equipe->membros()->attach($request->input('user_id'), ['role' => 'membro']);

        return redirect()->route('equipes.show', $equipe)->with('success', 'Membro adicionado com sucesso!');
    }

    // Remover membro da equipe
    public function destroyMembro(Equipe $equipe, User $membro)
    {
        Gate::authorize('equipe.update');

        $equipe->membros()->detach($membro->id);

        return redirect()->route('equipes.show', $equipe)->with('success', 'Membro removido com sucesso!');
    }

    // Exibir o formulário para adicionar gestor
    public function createGestor(Equipe $equipe)
    {
        Gate::authorize('equipe.update');

        $usuarios = User::all();

        return view('equipes.gestores.create', compact('equipe', 'usuarios'));
    }

    // Salvar novo gestor na equipe
    public function storeGestor(Request $request, Equipe $equipe)
    {
        Gate::authorize('equipe.update');

        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $equipe->gestores()->attach($request->input('user_id'), ['role' => 'gestor']);

        return redirect()->route('equipes.show', $equipe)->with('success', 'Gestor adicionado com sucesso!');
    }

    // Remover gestor da equipe
    public function destroyGestor(Equipe $equipe, User $gestor)
    {
        Gate::authorize('equipe.update');

        $equipe->gestores()->detach($gestor->id);

        return redirect()->route('equipes.show', $equipe)->with('success', 'Gestor removido com sucesso!');
    }
}
