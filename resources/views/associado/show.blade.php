@extends('layouts.main')

@section('title', 'Aspra Associado')

@section('content')

    <div class="container">
        <h1>Informações do associado</h1>
        @if ($associado->id != null)
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
                        Tipo: {{ $documento->tipo_documento }} - Status: {{ $documento->status }} - Observação:
                        {{ $documento->observacao }}
                    </li>
                    
                @endforeach
            </ul>
        @else
            <p>Não há documentos associados a este associado.</p>
        @endif
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Inserir Documento
        </button>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h1>Documentos de {{ $associado->nome }}</h1>

                        {{-- Formulário de envio --}}
                        <form action="{{ route('associado.documentos.store', $associado->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <label>Tipo de Documento</label>
                            <select class="form-select" name="tipo_documento" required>
                                <option value="identidade">Identidade</option>
                                <option value="comprovante_residencia">Comprovante de Residência</option>
                                <option value="cpf">CPF</option>
                            </select>

                            <label>Arquivo</label>
                            <input class="form-control" type="file" name="arquivo" required>

                            <label>Observação</label>
                            <textarea class="form-control" name="observacao"></textarea>

                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
                                <button type="submit" class="btn btn-primary">Inserir</button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>


        <div class="container border-top mt-4 pt-4">
            <h2>Histórico de Situações do associado</h2>
            @if ($associado->historicoSituacoes && $associado->historicoSituacoes->count() > 0)
                <ul>
                    @foreach ($associado->historicoSituacoes as $historico)
                        <li>
                            Situação: {{ $historico->situacao }} - Data de início: {{ $historico->data_inicio }} - Data de
                            fim:
                            {{ $historico->data_fim ?? 'Ativo' }}
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
                            Mês/Ano: {{ $mensalidade->mes_ano }} - Valor: R$
                            {{ number_format($mensalidade->valor, 2, ',', '.') }} - Status: {{ $mensalidade->status }}
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
