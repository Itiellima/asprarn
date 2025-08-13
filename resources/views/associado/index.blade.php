@extends('layouts.main')

@section('title', 'Aspra Associado')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Lista de associados</h1>
    </div>

    <div id="search-container" class="col-md-12 mb-3">
        <label for="form-label">Busque um associado</label>
        <form method="GET" action="{{ route('associado.index') }}">
            <input class="form-control" type="text" name="search" value="{{ $search ?? '' }}" placeholder="Pesquisar evento">
        </form>

    </div>

    @if (!@empty($search))
        <p>Você pesquisou por: <strong>{{ $search }}</strong></p>
    @else
        
    @endif

    @if ($associados->isEmpty())
        <p>Nenhum associado encontrado.</p>
    @else
        <p>Existem {{ $associados->count() }} associados cadastrados.</p>
        <table class="table table-striped table-hover ">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">CPF</th>
                <th scope="col" style="width: 200px;">Ação</th>
            </tr>
            @foreach ($associados as $associado)
                <tr>
                    <td>{{ $associado->id }}</td>
                    <td>{{ $associado->nome }}</td>
                    <td>{{ $associado->cpf }}</td>
                    <td>
                        <a href="/associado/edit/{{ $associado->id }}">Ver informações</a>
                    </td>
                </tr>
            @endforeach
        </table>

    @endif

    <div>
        @auth

            <p>Você está autenticado como: <strong>{{ auth()->user()->name }}</strong></p>
            @hasanyrole('admin|moderador|user')
                <p><strong>Any Role</strong></p>
            @endhasanyrole

            @role('admin')
                <p><strong>ADMINISTRADOR</strong></p>
            @endrole

            @role('moderador')
                <p><strong>MODERADOR</strong></p>
            @endrole

            @role('user')
                <p><strong>USUÁRIO</strong></p>
            @endrole


        @endauth
    </div>




@endsection
