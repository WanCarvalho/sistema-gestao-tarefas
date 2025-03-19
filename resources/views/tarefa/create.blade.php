@extends('layouts.app', [
    'header' => 'Nova Tarefa',
])

@section('content')
    <form action="{{ isset($tarefa) ? route('tarefas.update', $tarefa->slug) : route('tarefas.store') }}" method="POST">
        @csrf
        @if (isset($tarefa))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo"
                value="{{ old('titulo', $tarefa->titulo ?? '') }}"
                {{ !auth()->user()->can('tarefa.edit') ? 'readonly' : '' }} required>
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao" rows="3">{{ old('descricao', $tarefa->descricao ?? '') }}</textarea>
        </div>

        <div class="row">
            <div class="col-6 mb-3">
                <label for="prazo_final" class="form-label">Prazo Final</label>
                <input type="date" class="form-control" id="prazo_final" name="prazo_final"
                    value="{{ old('prazo_final', $tarefa->prazo_final ?? now()->addWeek()->format('Y-m-d')) }}"
                    min="{{ now()->format('Y-m-d') }}" {{ !auth()->user()->can('tarefa.edit') ? 'readonly' : '' }}>
            </div>

            <div class="col-6 mb-3">
                <label for="prioridade" class="form-label">Prioridade</label>
                <select class="form-select" id="prioridade" name="prioridade"
                    {{ !auth()->user()->can('tarefa.edit') ? 'readonly' : '' }}>
                    <option value="baixa" {{ old('prioridade', $tarefa->prioridade ?? '') == 'baixa' ? 'selected' : '' }}>
                        Baixa</option>
                    <option value="media" {{ old('prioridade', $tarefa->prioridade ?? '') == 'media' ? 'selected' : '' }}>
                        Média</option>
                    <option value="alta" {{ old('prioridade', $tarefa->prioridade ?? '') == 'alta' ? 'selected' : '' }}>
                        Alta</option>
                </select>
            </div>
        </div>

        <div class="form-group mb-3">
            <label for="responsavel_id">Responsável</label>
            <select class="form-control" id="responsavel_id" name="responsavel_id" required
                {{ !auth()->user()->can('tarefa.edit') ? 'readonly' : '' }}>
                <option value="">Selecione um responsável</option>
                @foreach ($usuarios as $usuario)
                    <option value="{{ $usuario->id }}"
                        {{ isset($tarefa) && $tarefa->responsavel_id == $usuario->id ? 'selected' : '' }}>
                        {{ $usuario->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <a href="{{ route('tarefas.index') }}" class="btn btn-danger">Cancelar</a>
        <button type="submit" class="btn btn-primary">{{ isset($tarefa) ? 'Atualizar' : 'Cadastrar' }} Tarefa</button>
    </form>
@endsection
