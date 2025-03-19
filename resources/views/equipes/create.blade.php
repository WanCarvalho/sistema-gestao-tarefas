@extends('layouts.app', [
    'header' => 'Nova Equipe',
])

@section('content')
    <h3>Criar Nova Equipe</h3>

    <form action="{{ route('equipes.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nome da Equipe</label>
            <input type="text" name="nome" class="form-control" required>
        </div>

        <a class="btn btn-danger" href="{{ route('equipes.index') }}">Cancelar</a>
        <button type="submit" class="btn btn-primary">Criar Equipe</button>
    </form>
@endsection
