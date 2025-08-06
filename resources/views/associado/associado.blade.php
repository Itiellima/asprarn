@extends('layouts.main')

@section('title', 'Aspra Associado')

@section('content')
    
    <div class="container">
        <h1>Informações do associado</h1>
        @if ($id != null)
            <p>ID do associado: {{ $id }}</p>
            
        @endif

    </div>
    
@endsection