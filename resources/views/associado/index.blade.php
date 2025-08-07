@extends('layouts.main')

@section('title', 'Aspra Associado')

@section('content')

    <div>
        <h1>Lista de associados</h1>
    </div>

    @if ($associados->isEmpty())
        <p>Nenhum associado encontrado.</p>
    @endif
    @foreach ($associados as $associado)
        <div class="container border p-3 mb-3">
            <h1>Informações do associado</h1>
            <p>ID do associado: {{ $associado->id }}</p>
            <p>Nome: {{ $associado->nome }}</p>
            <p>Data de Nascimento: {{ $associado->data_nascimento }}</p>
            <p>Cidade: {{ $associado->cidade }}</p>
            <a href="/associado/{{ $associado->id }}">Editar</a>
            <a href="#">Excluir</a>
        </div>
    @endforeach





@endsection
