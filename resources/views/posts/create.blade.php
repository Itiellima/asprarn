@extends('layouts.main')

@section('title', '')

@section('content')


    <div class="meu-container alert alert-light">
        <h1>Nova Publicação</h1>
    </div>

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="container row mb-3">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Titulo da publicação</label>
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Assunto</label>
                <input type="text" class="form-control" id="assunto" name="assunto"
                    placeholder="Assunto da publicação">
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Insira as fotos</label>
                <input class="form-control" type="file" id="img" name="img">
            </div>
            <div class="mb-3 col-3">
                <label for="exampleFormControlInput1" class="form-label">Data de referencia</label>
                <input type="date" class="form-control" id="data" name="data" placeholder="date">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Texto do Post</label>
                <textarea class="form-control" id="texto" name="texto" rows="3" placeholder="Insira o texto do post aqui"></textarea>
            </div>
            <input type="submit" name="submit" id="submitBtn" class="btn btn-primary" value="Salvar">
        </div>





    </form>















@endsection
