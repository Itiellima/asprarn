@extends('layouts.main')

@section('title', 'Documentos do Associado')

@section('content')
    <div class="container">
        <h1>Documentos de {{ $associado->nome }}</h1>

        <div class="container border mt-3 my-4">
            {{-- DOCUMENTOS DIV --}}
            <div class="container pt-4">

                {{-- MODAL INSERSAO --}}
                <div class="">
                    {{-- Botão para abrir modal de inderir documento --}}
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Inserir Documento
                    </button>

                    {{-- Modal de inserir documento --}}
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h3>Documentos de {{ $associado->nome }}</h3>

                                    {{-- Formulário de envio documento --}}
                                    <form action="{{ route('associado.documentos.store', $associado->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <label>Tipo de Documento</label>
                                        <input type="text" class="form-control" name="tipo_documento" required>

                                        <label>Arquivo: pdf, jpg, jpeg, png.</label>
                                        <input class="form-control" type="file" name="arquivo" required>

                                        <label>Observação</label>
                                        <textarea class="form-control" name="observacao"></textarea>

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

                <h3>Documentos do associado</h3>
                @if ($associado->files && $associado->files->count() > 0)
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
                            @foreach ($associado->files as $file)
                                <tr>
                                    <td>{{ $file->tipo_documento }}</td>
                                    <td>{{ ucfirst($file->status) }}</td>
                                    <td>{{ $file->observacao }}</td>
                                    <td>
                                        <a href="{{ route('associado.documentos.show', [$associado->id, $file->id]) }}"
                                            class="btn btn-sm btn-primary" target="_blank">
                                            Visualizar
                                        </a>

                                        {{-- Botão para abrir modal de edição --}}
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#modalEditDocumento{{ $file->id }}">
                                            Editar
                                        </button>

                                        {{-- Modal de edição --}}
                                        <div class="modal fade" id="modalEditDocumento{{ $file->id }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="modalLabel{{ $file->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title fs-5" id="modalLabel{{ $file->id }}">
                                                            Editar Documento de {{ $file->nome }}
                                                        </h3>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Fechar"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form
                                                            action="{{ route('associado.documentos.update', [$associado->id, $file->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <div class="mb-3">
                                                                <label>Status</label>
                                                                <select class="form-control" name="status">
                                                                    <option value="pendente"
                                                                        {{ $file->status == 'pendente' ? 'selected' : '' }}>
                                                                        Pendente</option>
                                                                    <option value="recebido"
                                                                        {{ $file->status == 'recebido' ? 'selected' : '' }}>
                                                                        Recebido</option>
                                                                    <option value="rejeitado"
                                                                        {{ $file->status == 'rejeitado' ? 'selected' : '' }}>
                                                                        Rejeitado</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label>Observação</label>
                                                                <input class="form-control" type="text" name="observacao"
                                                                    value="{{ $file->observacao }}"
                                                                    placeholder="Observação">
                                                            </div>
                                                            <button class="btn btn-success"
                                                                type="submit">Atualizar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Formulário de exclusão --}}
                                        <form
                                            action="{{ route('associado.documentos.destroy', [$associado->id, $file->id]) }}"
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







            </div>
        </div>
    @endsection
