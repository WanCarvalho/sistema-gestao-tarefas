@extends('layouts.app', [
    'header' => 'Atualizar Usuário',
])

@section('content')
    <form action="{{ route('usuarios.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="name">Nome</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}"
                required>
        </div>

        <div class="form-group mb-3">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" class="form-control"
                value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="password">Senha</label>
            <input type="password" id="password" name="password" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="password_confirmation">Confirmar Senha</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
        </div>

        <!-- Campo de Seleção de Roles -->
        <div class="form-group mb-3">
            <label for="role">Role</label>
            <select id="role" name="role" class="form-control" required>
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}" {{ $role->name == $user->roles->first()->name ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <a href="{{ route('usuarios.index') }}" class="btn btn-danger">Cancelar</a>
        <button type="submit" class="btn btn-primary">Atualizar Usuário</button>
    @endsection
