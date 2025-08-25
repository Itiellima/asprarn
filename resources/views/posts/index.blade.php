@extends('layouts.main')

@section('title', '')

@section('content')

    <div class="meu-container">
        <h1>Index</h1>
    </div>

    <div class="container mb-3">
        <h3>Nova publicação</h3>
        <a href="{{ route('posts.create') }}" class="btn btn-primary"> + Nova Publicação</a>
    </div>
    @if ($posts->count())
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Assunto</th>
                    <th scope="col">Data</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Img</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <th scope="row">{{ $post->id }}</th>
                        <td>{{ $post->titulo }}</td>
                        <td>{{ $post->assunto }}</td>
                        <td>{{ $post->data->format('d/m/Y') }}</td>
                        <td>{{ $post->user->name }}</td>
                        <td>
                            @if ($post->img)
                                <img src="{{ asset('storage/' . $post->img) }}" alt="imagem" width="80">
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                onsubmit="return confirm('Deseja excluir essa publicação?')">
                                @csrf
                                @method('DELETE')


                                <button type="submit" class="btn btn-danger">🗑️ Excluir</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h1>Nenhuma publicação encontrada</h1>
    @endif





@endsection
