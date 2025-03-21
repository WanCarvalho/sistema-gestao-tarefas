@extends('layouts.app', [
    'header' => 'Visualizar ' . $equipe->nome,
])

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="h5">Listar</h3>
    </div>

    <div class="my-4">
        <div class="card shadow">
            <div class="card-body">
                <!-- Abas para Membros e Gestores -->
                <ul class="nav nav-tabs" id="equipeTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="membros-tab" data-bs-toggle="tab" href="#membros" role="tab"
                            aria-controls="membros" aria-selected="true">Membros</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="gestores-tab" data-bs-toggle="tab" href="#gestores" role="tab"
                            aria-controls="gestores" aria-selected="false">Gestores</a>
                    </li>
                </ul>

                <div class="tab-content mt-3" id="equipeTabsContent">
                    <!-- Tabela para Membros -->
                    <div class="tab-pane fade show active" id="membros" role="tabpanel" aria-labelledby="membros-tab">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5>Membros da Equipe</h5>
                            @if (Auth::user()->can('equipe.update'))
                                <a href="{{ route('equipes.membros.create', $equipe->id) }}" class="btn btn-primary btn-sm">
                                    Adicionar Membro
                                </a>
                            @endif
                        </div>

                        <table class="table table-borderless table-striped table-hover">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($membros as $membro)
                                    <tr>
                                        <td>{{ $membro->name }}</td>
                                        <td>
                                            @if (Auth::user()->can('equipe.update'))
                                                <form action="{{ route('equipes.membros.destroy', [$equipe->id, $membro->id]) }}" method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Tem certeza que deseja excluir este membro da equipe?');">
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

                    <!-- Tabela para Gestores -->
                    <div class="tab-pane fade" id="gestores" role="tabpanel" aria-labelledby="gestores-tab">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5>Gestores da Equipe</h5>
                            @if (Auth::user()->can('equipe.update'))
                                <a href="{{ route('equipes.gestores.create', $equipe->id) }}" class="btn btn-primary btn-sm">
                                    Adicionar Gestor
                                </a>
                            @endif
                        </div>

                        <table class="table table-borderless table-striped table-hover">
                            <thead class="table-success">
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gestores as $gestor)
                                    <tr>
                                        <td>{{ $gestor->name }}</td>
                                        <td>
                                            @if (Auth::user()->can('equipe.update'))
                                                <form action="{{ route('equipes.gestores.destroy', [$equipe->id, $gestor->id]) }}" method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Tem certeza que deseja excluir este gestor da equipe?');">
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
        </div>
    </div>
@endsection
