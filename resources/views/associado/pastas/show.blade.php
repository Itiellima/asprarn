@extends('layouts.main')

@section('title', 'Aspra Associado')

@section('content')

<div class="container">
    <h2>Show pasta/arquivos</h2>
    <h2>{{ $pasta->nome }}</h2>
</div>

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
                                    <form action="{{ route('associado.documentos.store', $pasta->id) }}" method="POST"
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


@endsection