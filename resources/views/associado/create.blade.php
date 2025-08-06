@extends('layouts.main')

@section('title', 'Novo associado')

@section('content')


    <h1>Insira os dados do novo associado</h1>

    <div class="container row mb-3">
        <div class="col-md-6">
            <form action="/associado/store" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="formGroup" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome"
                        placeholder="Insira o nome do associado" required>
                </div>
                <div class="mb-3">
                    <label for="formGroup" class="form-label">Data de nascimento</label>
                    <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" placeholder="Insira a data de nascimento" required>
                </div>
                <div class="mb-3">
                    <label for="formGroup" class="form-label">Cidade</label>
                    <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Insira o nome da cidade" required>
                </div>
                <input type="submit" class="btn btn-primary" value="Salvar">
            </form>
        </div>
    </div>


@endsection
