@extends('layouts.main')

@section('title', 'Aspra Associado')

@section('content')
    
    <div class="container">
        <h1>Informações do associado</h1>
        @if ($associado->id != null)
            <p>ID do associado: {{ $associado->id }}</p>
            <p>Nome do associado {{ $associado->nome }}</p>
            <p>Data de nascimento: {{ $associado->data_nascimento }}</p>
            <p>Cidade: {{ $associado->cidade }}</p>
        @endif
    </div>
    
@endsection