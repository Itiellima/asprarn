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
        @else
            <p>Associado não encontrado.</p>
        @endif
    </div>
    
    <div class="container">
        <h2>Documentos do associado</h2>
        @if ($associado->documentos && $associado->documentos->count() > 0)
            <ul>
                @foreach ($associado->documentos as $documento)
                    <li>
                        Tipo: {{ $documento->tipo_documento }} - Status: {{ $documento->status }} - Observação: {{ $documento->observacao }}
                    </li>
                @endforeach
            </ul>
        @else
            <p>Não há documentos associados a este associado.</p>
        @endif
    </div>
    <div class="container">
        <h2>Histórico de Situações do associado</h2>
        @if ($associado->historicoSituacoes && $associado->historicoSituacoes->count() > 0)
            <ul>
                @foreach ($associado->historicoSituacoes as $historico)
                    <li>
                        Situação: {{ $historico->situacao }} - Data de início: {{ $historico->data_inicio }} - Data de fim: {{ $historico->data_fim ?? 'Ativo' }}
                    </li>
                @endforeach
            </ul>
        @else
            <p>Não há histórico de situações para este associado.</p>
        @endif
    </div>
    <div class="container">
        <h2>Mensalidades do associado</h2>
        @if ($associado->mensalidades && $associado->mensalidades->count() > 0)
            <ul>
                @foreach ($associado->mensalidades as $mensalidade)
                    <li>
                        Mês/Ano: {{ $mensalidade->mes_ano }} - Valor: R$ {{ number_format($mensalidade->valor, 2, ',', '.') }} - Status: {{ $mensalidade->status }}
                    </li>
                @endforeach
            </ul>
        @else
            <p>Não há mensalidades para este associado.</p>
        @endif
    </div>
    <div class="container">
        
    </div>
    
@endsection