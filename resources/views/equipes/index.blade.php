@extends('layouts.app', [
    'header' => 'Equipes',
])

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="h5">Listar</h3>
        @if (Auth::user()->can('equipe.create'))
            <a href="{{ route('equipes.create') }}" class="btn btn-primary">Criar Equipe</a>
        @endif
    </div>

    <div class="my-4 row">
        @foreach ($equipes as $equipe)
            <div class="col-md-4 mb-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">#{{ $equipe->id }} - {{ $equipe->nome }}</h5>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('equipes.show', $equipe->id) }}"
                                class="btn btn-info btn-sm mr-2">Visualizar</a>
                            <a href="{{ route('equipes.edit', $equipe->id) }}"
                                class="btn btn-warning btn-sm mr-2">Editar</a>
                            @if (Auth::user()->can('equipe.delete'))
                                <form action="{{ route('equipes.delete', $equipe->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Tem certeza que deseja excluir esta equipe?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $equipes->links() }} <!-- Paginação -->
    </div>
@endsection
