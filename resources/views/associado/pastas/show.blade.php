@extends('layouts.main')

@section('title', 'Aspra Associado')

@section('content')

<div class="container">
    <h2>Show pasta/arquivos</h2>
    <h2>{{ $pasta->nome }}</h2>
</div>


@endsection