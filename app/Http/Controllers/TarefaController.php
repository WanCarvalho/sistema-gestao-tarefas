<?php

namespace App\Http\Controllers;

use App\Enums\StatusTarefaEnum;
use App\Http\Requests\TarefaRequest;
use App\Models\Tarefa;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TarefaController extends Controller
{
    public function index()
    {
        try {
            Gate::authorize('tarefa.view');

            $tarefas = Tarefa::query()
                // ->where('user_id', Auth::id())
                ->orderBy('created_at', 'DESC')
                ->paginate(10);

            return view('tarefa.index', [
                'tarefas' => $tarefas
            ]);
        } catch (Exception $e) {
            return back()->with('error', 'Erro ao carregar as tarefas: ' . $e->getMessage());
        }
    }

    public function create()
    {
        Gate::authorize('tarefa.create');

        return view('tarefa.create');
    }

    public function edit(Tarefa $tarefa)
    {
        Gate::authorize('tarefa.edit');

        return view('tarefa.create', [
            'tarefa' => $tarefa,
        ]);
    }

    public function store(TarefaRequest $request)
    {
        try {
            Gate::authorize('tarefa.store');

            Tarefa::query()
                ->create($request->validated());

            return redirect()->route('tarefas.index')->with('success', 'Tarefa cadastrada com sucesso!');
        } catch (Exception $e) {
            return redirect()->route('tarefas.store')->withInput()->with('error', 'Erro ao cadastrar tarefa: ' . $e->getMessage());
        }
    }

    public function update(TarefaRequest $request, Tarefa $tarefa)
    {
        try {
            Gate::authorize('tarefa.update');

            // Verifica se o usuário autenticado é o dono da tarefa
            if ($tarefa->user_id !== Auth::id()) {
                return back()->with('error', 'Você não tem permissão para editar esta tarefa.');
            }

            $tarefa->update($request->validated());

            return redirect()->route('tarefas.index')->with('success', 'Tarefa atualizada com sucesso!');
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Erro ao atualizar tarefa: ' . $e->getMessage());
        }
    }

    public function delete(Tarefa $tarefa)
    {
        try {
            Gate::authorize('tarefa.delete');

            // Verifica se o usuário autenticado é o dono da tarefa
            if ($tarefa->user_id !== Auth::id()) {
                return back()->with('error', 'Você não tem permissão para excluir esta tarefa.');
            }

            $tarefa->delete();

            return redirect()->route('tarefas.index')->with('success', 'Tarefa excluída com sucesso!');
        } catch (Exception $e) {
            return back()->with('error', 'Erro ao excluir tarefa: ' . $e->getMessage());
        }
    }

    public function concluir(Tarefa $tarefa)
    {
        try {
            Gate::authorize('tarefa.concluir');

            // Verifica se o usuário autenticado é o dono da tarefa
            if ($tarefa->user_id !== Auth::id()) {
                return back()->with('error', 'Você não tem permissão para concluir esta tarefa.');
            }

            // Atualiza o status da tarefa para "Concluída"
            $tarefa->update([
                'status' => StatusTarefaEnum::CONCLUIDO,
            ]);

            return redirect()->route('tarefas.index')->with('success', 'Tarefa concluída com sucesso!');
        } catch (Exception $e) {
            return back()->with('error', 'Erro ao concluir tarefa: ' . $e->getMessage());
        }
    }
}
