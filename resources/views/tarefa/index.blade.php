@extends('layouts.app', [
    'header' => 'Tarefas',
])

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="h5">Listar</h3>
        @if (Auth::user()->can('tarefa.create'))
            <a href="{{ route('tarefas.create') }}" class="btn btn-primary">Criar Tarefa</a>
        @endif
    </div>

    <!-- Filtro de Tarefas -->
    <div class="my-4">
        <form action="{{ route('tarefas.index') }}" method="GET">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" name="status" id="status">
                        <option value="">Todos</option>
                        <option value="em-andamento" {{ request('status') == 'em-andamento' ? 'selected' : '' }}>Em Andamento</option>
                        <option value="concluida" {{ request('status') == 'concluida' ? 'selected' : '' }}>Concluído</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="prioridade" class="form-label">Prioridade</label>
                    <select class="form-select" name="prioridade" id="prioridade">
                        <option value="">Todas</option>
                        <option value="baixa" {{ request('prioridade') == 'baixa' ? 'selected' : '' }}>Baixa</option>
                        <option value="media" {{ request('prioridade') == 'media' ? 'selected' : '' }}>Média</option>
                        <option value="alta" {{ request('prioridade') == 'alta' ? 'selected' : '' }}>Alta</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                    <!-- Botão para limpar os filtros -->
                    <a href="{{ route('tarefas.index') }}" class="btn btn-secondary ms-2">Limpar Filtros</a>
                </div>
            </div>
        </form>
    </div>

    <div class="my-4">
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-borderless table-striped table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Título</th>
                            <th scope="col">Status</th>
                            <th scope="col">Prioridade</th>
                            <th scope="col">Prazo Final</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tarefas as $tarefa)
                            <tr>
                                <td>{{ $tarefa->id }}</td>
                                <td>{{ $tarefa->titulo }}</td>
                                <td>{{ ucfirst($tarefa->status) }}</td>
                                <td>{{ ucfirst($tarefa->prioridade) }}</td>
                                <td>{{ \Carbon\Carbon::parse($tarefa->prazo_final)->format('d/m/Y') }}</td>
                                <td>
                                    <form action="{{ route('tarefas.concluir', $tarefa->slug) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Tem certeza que deseja concluir esta tarefa?');">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success btn-sm">Concluir</button>
                                    </form>
                                    <a href="{{ route('tarefas.edit', $tarefa->slug) }}"
                                        class="btn btn-warning btn-sm">Editar</a>
                                    @if (Auth::user()->can('tarefa.delete'))
                                        <form action="{{ route('tarefas.delete', $tarefa->slug) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Tem certeza que deseja excluir esta tarefa?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-4">
        {{ $tarefas->links() }} <!-- Paginação -->
    </div>
@endsection
