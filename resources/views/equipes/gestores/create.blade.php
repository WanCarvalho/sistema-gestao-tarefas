@extends('layouts.app')

@section('content')
    <h3>Adicionar Gestor à Equipe {{ $equipe->nome }}</h3>

    <form action="{{ route('equipes.gestores.store', $equipe->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="user_id" class="form-label">Selecionar Usuário</label>
            <select name="user_id" id="user_id" class="form-control" required>
                <option value="">Selecione um usuário</option>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Adicionar</button>
    </form>
@endsection
