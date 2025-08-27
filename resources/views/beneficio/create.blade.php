@extends('layouts.main')

@section('title', '')

@section('content')

    <form action="" method="" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-3">

            <div class="mb-3">
                <label for="nome" class="form-label">Beneficio</label>
                <input type="text" class="form-control" id="nome" name="nome"
                    placeholder="Example input placeholder">
            </div>

            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <input type="text" class="form-control" id="descricao" name="descricao"
                    placeholder="Insira a descrição do beneficio">
            </div>

            <div class="mb-3">
                <label for="img" class="form-label">Adicione uma imagem</label>
                <input class="form-control" type="file" id="img" name="img">
            </div>

            <button class="btn btn-primary">
                Salvar
            </button>

        </div>


    </form>





@endsection
