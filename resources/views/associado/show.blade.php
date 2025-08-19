@extends('layouts.main')

@section('title', 'Aspra Associado')

@section('content')

    <div class="container border">
        <h1>Informações do associado</h1>
        @if ($associado->id != null)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Data de Nascimento</th>
                        <th>Telefone</th>
                        <th>Email</th>
                        <th>Ação</th>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $associado->nome }}</td>
                        <td>{{ $associado->dt_nasc }}</td>
                        <td>{{ $associado->contato->tel_celular }}</td>
                        <td>{{ $associado->contato->email }}</td>
                        <td>
                            <a href="/associado/edit/{{ $associado->id }}">Ver tudo</a>
                            <a href="{{ route('associado.pdf.requerimento', $associado->id) }}" target="_blank">
                                Gerar requerimento
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        @else
            <p>Associado não encontrado.</p>
        @endif
    </div>

    <div class="container align-items-center border">
        <form action="{{ route('associado.situacao.store', $associado->id) }}" method="POST">
            @csrf

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="ativo" name="ativo" value="1"
                    {{ old('ativo', $associado->situacao->ativo ?? false) ? 'checked' : '' }}>
                <label class="form-check-label" for="ativo">Ativo</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inadimplente" name="inadimplente" value="1"
                    {{ old('ativo', $associado->situacao->inadimplente ?? false) ? 'checked' : '' }}>
                <label class="form-check-label" for="inadimplente">Inadimplente</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="pendente_documento" name="pendente_documento"
                    value="1" {{ old('ativo', $associado->situacao->pendente_documento ?? false) ? 'checked' : '' }}>
                <label class="form-check-label" for="pendente_documento">Pendente documento</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="pendente_financeiro" name="pendente_financeiro"
                    value="1" {{ old('ativo', $associado->situacao->pendente_financeiro ?? false) ? 'checked' : '' }}>
                <label class="form-check-label" for="pendente_financeiro">Pendente financeiro</label>
            </div>

            <button type="submit" class="btn btn-primary mt-3 mb-3">Salvar</button>

        </form>
    </div>


    <div class="container border mt-3">
        <h2>Documentos do associado</h2>
        @if ($associado->documentos && $associado->documentos->count() > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Status</th>
                        <th>Observação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($associado->documentos as $documento)
                        <tr>
                            <td>{{ $documento->tipo_documento }}</td>
                            <td>{{ ucfirst($documento->status) }}</td>
                            <td>{{ $documento->observacao }}</td>
                            <td>
                                <a href="{{ route('associado.documentos.show', [$associado->id, $documento->id]) }}"
                                    class="btn btn-sm btn-primary" target="_blank">
                                    Visualizar
                                </a>

                                {{-- Botão para abrir modal de edição --}}
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalEditDocumento{{ $documento->id }}">
                                    Editar
                                </button>

                                {{-- Modal de edição --}}
                                <div class="modal fade" id="modalEditDocumento{{ $documento->id }}"
                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                    aria-labelledby="modalLabel{{ $documento->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="modalLabel{{ $documento->id }}">
                                                    Editar Documento de {{ $associado->nome }}
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Fechar"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form
                                                    action="{{ route('associado.documentos.update', [$associado->id, $documento->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="mb-3">
                                                        <label>Status</label>
                                                        <select class="form-control" name="status">
                                                            <option value="pendente"
                                                                {{ $documento->status == 'pendente' ? 'selected' : '' }}>
                                                                Pendente</option>
                                                            <option value="recebido"
                                                                {{ $documento->status == 'recebido' ? 'selected' : '' }}>
                                                                Recebido</option>
                                                            <option value="rejeitado"
                                                                {{ $documento->status == 'rejeitado' ? 'selected' : '' }}>
                                                                Rejeitado</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Observação</label>
                                                        <input class="form-control" type="text" name="observacao"
                                                            value="{{ $documento->observacao }}" placeholder="Observação">
                                                    </div>
                                                    <button class="btn btn-success" type="submit">Atualizar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Formulário de exclusão --}}
                                <form
                                    action="{{ route('associado.documentos.destroy', [$associado->id, $documento->id]) }}"
                                    method="POST" style="display:inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" type="submit"
                                        onclick="return confirm('Tem certeza que deseja excluir este documento?')">
                                        Excluir
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Não há documentos associados a este associado.</p>
        @endif
        {{-- Botão para abrir modal de inderir documento --}}
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Inserir Documento
        </button>

        {{-- Modal de inserir documento --}}
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

                        {{-- Formulário de envio documento --}}
                        <form action="{{ route('associado.documentos.store', $associado->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <label>Tipo de Documento</label>
                            <select class="form-select" name="tipo_documento" required>
                                <option value="Identidade">Identidade</option>
                                <option value="Comprovante de Residência">Comprovante de Residência</option>
                                <option value="CPF">CPF</option>
                                <option value="Procuração">Procuração</option>
                                <option value="Outro">Outro</option>
                            </select>

                            <label>Arquivo: pdf, jpg, jpeg, png.</label>
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

        {{-- Painel Historico de situação --}}
        <div class="container border-top mt-4 pt-4">
            <h2>Histórico de Situações do associado</h2>
            @if ($associado->historicoSituacoes && $associado->historicoSituacoes->count() > 0)
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Situação</th>
                            <th>Data de inicio</th>
                            <th>Data de finalização</th>
                            <th>Observacao</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($associado->historicoSituacoes as $historico)
                            <tr>
                                <td>{{ $historico->situacao }}</td>
                                <td>{{ $historico->data_inicio }}</td>
                                <td>{{ $historico->data_fim }}</td>
                                <td>{{ $historico->observacao }}</td>
                                <td>
                                    <form
                                        action="{{ route('associado.historico.destroy', [$associado->id, $historico->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit"
                                            onclick="return confirm('Tem certeza que deseja excluir este historico?')">
                                            Excluir
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Não há histórico de situações para este associado.</p>
            @endif

            {{-- Botão para abrir modal de inserir historico --}}
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop3">
                Inserir Historico
            </button>

            {{-- Modal Historico --}}
            <div class="modal fade" id="staticBackdrop3" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel3" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel3">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h2>Historico de {{ $associado->nome }}</h2>
                            {{-- Formulário de envio documento --}}
                            <form action="{{ route('associado.historico.store', $associado->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <label>Tipo de Documento</label>
                                <input type="text" class="form-control" name="situacao" required>
                                <label>Observação</label>
                                <input type="text" class="form-control" name="observacao">
                                <label>Data de Inicio</label>
                                <input type="date" class="form-control" name="data_inicio" required>
                                <label>Encerramento</label>
                                <input type="date" class="form-control" name="data_fim">

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Voltar</button>
                                    <button type="submit" class="btn btn-primary">Inserir</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- Painel Mensalidades --}}
        <div class="container border-top mt-4 pt-4">
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
