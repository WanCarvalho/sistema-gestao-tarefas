@extends('layouts.app', [
    'header' => 'Usuários'
])

@section('content')
<div class="d-flex justify-content-between align-items-center">
    <h3 class="h5">Listar</h3>
    @if (Auth::user()->can('usuario.create'))
        <a href="{{ route('usuarios.create') }}" class="btn btn-primary">Adicionar Usuário</a>
    @endif
</div>

    <table class="table table-bordered mt-4">
        <thead class="table-dark">
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>
                        <a href="{{ route('usuarios.edit', $usuario) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('usuarios.destroy', $usuario) }}" method="POST" class="d-inline" onsubmit="return confirm('Deseja excluir este usuário?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $usuarios->links() }}
@endsection
