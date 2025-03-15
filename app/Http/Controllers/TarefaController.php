<?php

namespace App\Http\Controllers;

use App\Enums\StatusTarefaEnum;
use App\Http\Requests\TarefaRequest;
use App\Models\Tarefa;
use Exception;
use Illuminate\Support\Facades\Auth;

class TarefaController extends Controller
{
    public function index()
    {
        try {
            $tarefas = Tarefa::query()
                // ->where('user_id', Auth::id())
                ->paginate(10);

            return view('tarefa.index', [
                'tarefas' => $tarefas
            ]);
        } catch (Exception $e) {
            return back()->with('error', 'Erro ao carregar as tarefas: ' . $e->getMessage());
        }
    }

    public function store(TarefaRequest $request)
    {
        try {
            Tarefa::query()
                ->create($request->toArray());

            return redirect()->route('tarefas.index')->with('success', 'Tarefa cadastrada com sucesso!');
        } catch (Exception $e) {
            return back()->with('error', 'Erro ao cadastrar tarefa: ' . $e->getMessage());
        }
    }

    public function update(TarefaRequest $request, Tarefa $tarefa)
    {
        try {
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
