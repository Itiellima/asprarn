@extends('layouts.main')

@section('title', 'Aspra Associado')

@section('content')
    @if (session('msg'))
        <div class="alert alert-success">
            {{ session('msg') }}
        </div>
    @endif
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Lista de associados</h1>
    </div>

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




@endsection
