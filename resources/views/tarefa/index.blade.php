@extends('layouts.app', [
    'header' => 'Tarefas',
])

@section('content')
    <div class="py-12">
        <div class="container-fluid pr-6 pl-6">
            <div class="bg-white overflow-hidden shadow-sm rounded">
                <div class="p-6 text-gray-900">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="h5">Listar</h3>
                        <a href="{{ route('tarefas.create') }}" class="btn btn-primary">Criar Tarefa</a>
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
                                                    <form action="{{ route('tarefas.concluir', $tarefa->slug) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja concluir esta tarefa?');">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-success btn-sm">Concluir</button>
                                                    </form>
                                                    <a href="{{ route('tarefas.edit', $tarefa->slug) }}" class="btn btn-warning btn-sm">Editar</a>
                                                    <form action="{{ route('tarefas.delete', $tarefa->slug) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir esta tarefa?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                                    </form>
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
                </div>
            </div>
        </div>
    </div>
@endsection
