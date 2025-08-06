@extends('layouts.main')

@section('title', 'Aspra Associado')

@section('content')

<div>
    <h1>Pagina do associado</h1>
</div>

    @foreach ($associados as $associados)
        <div class="container border p-3 mb-3">
            <h1>Informações do associado</h1>
            <p>ID do associado: {{ $associados->id }}</p>
            <p>Nome: {{ $associados->nome }}</p>
            <p>Data de Nascimento: {{ $associados->data_nascimento }}</p>
            <p>Cidade: {{ $associados->cidade }}</p>
            <a href="/associado/{{ $associados->id }}">Editar</a>
            <a href="#">Excluir</a>
        </div>
    @endforeach
    
    
    


@endsection
