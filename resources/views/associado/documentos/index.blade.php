@extends('layouts.main')

@section('title', 'Documentos do Associado')

@section('content')
<div class="container">
    <h1>Documentos de {{ $associado->nome }}</h1>

    {{-- Formulário de envio --}}
    <form action="{{ route('associado.documentos.store', $associado->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Tipo de Documento</label>
        <select name="tipo_documento" required>
            <option value="identidade">Identidade</option>
            <option value="comprovante_residencia">Comprovante de Residência</option>
            <option value="cpf">CPF</option>
        </select>

        <label>Arquivo</label>
        <input type="file" name="arquivo" required>

        <label>Observação</label>
        <textarea name="observacao"></textarea>

        <button type="submit">Enviar</button>
    </form>

    {{-- Lista de documentos --}}
    <h2>Lista de Documentos</h2>
    @if($associado->documentos->count())
        <table class="table">
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Status</th>
                    <th>Arquivo</th>
                    <th>Observação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($associado->documentos as $documento)
                    <tr>
                        <td>{{ $documento->tipo_documento }}</td>
                        <td>{{ $documento->status }}</td>
                        <td><a href="{{ asset('storage/' . $documento->arquivo) }}" target="_blank">Ver</a></td>
                        <td>{{ $documento->observacao }}</td>
                        <td>
                            {{-- Form de update --}}
                            <form action="{{ route('associado.documentos.update', [$associado->id, $documento->id]) }}" method="POST" style="display:inline-block">
                                @csrf
                                @method('PATCH')
                                <select name="status">
                                    <option value="pendente" {{ $documento->status=='pendente' ? 'selected' : '' }}>Pendente</option>
                                    <option value="recebido" {{ $documento->status=='recebido' ? 'selected' : '' }}>Recebido</option>
                                    <option value="rejeitado" {{ $documento->status=='rejeitado' ? 'selected' : '' }}>Rejeitado</option>
                                </select>
                                <input type="text" name="observacao" value="{{ $documento->observacao }}" placeholder="Observação">
                                <button type="submit">Atualizar</button>
                            </form>

                            {{-- Form de delete --}}
                            <form action="{{ route('associado.documentos.destroy', [$associado->id, $documento->id]) }}" method="POST" style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Tem certeza?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Não há documentos cadastrados.</p>
    @endif
</div>
@endsection
