<?php

namespace App\Http\Controllers;

use App\Models\Equipe;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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
        try {
            //
        } catch (Exception $e) {
            return back()->with('error', '' . $e->getMessage());
        }
    }

    public function store()
    {
        try {
            //
        } catch (Exception $e) {
            return back()->with('error', '' . $e->getMessage());
        }
    }

    public function update()
    {
        try {
            //
        } catch (Exception $e) {
            return back()->with('error', '' . $e->getMessage());
        }
    }

    public function edit()
    {
        try {
            //
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
}
