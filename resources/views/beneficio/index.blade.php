@extends('layouts.main')

@section('title', '')

@section('content')





    <div class="meu-container mb-3">
        <h1>Clube de Beneficios</h1>
    </div>
    @auth
        @hasanyrole(['admin', 'moderador'])
            <div>
                <a href="{{ route('beneficio.create') }}" class="btn btn-success">Adicionar beneficio</a>
            </div>
        @endhasanyrole
    @endauth


    <div class="meu-container row">
        <div class="card mx-2 mb-3 col-6" style="width: 18rem;">
            <img src="/img/Aspra.png" class="card-img-top" alt="aspra">
            <div class="card-body">
                <h5 class="card-title">ASSISTÊNCIA FUNERÁRIA</h5>
                <p class="card-text">Cobertura de assistência funerária.</p>
                <a href="#" class="btn btn-primary">Ver mais</a>
                @auth
                    @hasanyrole(['admin', 'moderador'])
                        <a href="">Excluir</a>
                    @endhasanyrole
                @endauth
            </div>
        </div>


    </div>

    # NOME DESCRIÇÃO <br>
    1 ASSISTÊNCIA FUNERÁRIA Cobertura de assistência funerária.<br>
    2 ASSISTENCIA JURÍDICA Consultas, audiências, defesa administrativa e entradas em processos.<br>
    3 AUXÍLIO NATALIDADE Benefício referente a nascimento de filho.<br>
    4 BENEFÍCIO SOCIAL Benefícios sociais/lazer (MA-NOA, SESC) concedido aos associados e seus dependentes, de forma
    geral.<br>
    5 CONVENIO DR. CARLOS GURGEL Atendimento Odontológico<br>
    6 CONVENIO MULTIFAM Serviços clínicos, médicos e odontológicos<br>
    7 CONVENIO SEMPRE Serviço Funerário<br>
    8 CURSO DE INGLES WIZARD Desconto no curso de inglês .<br>
    9 FACULDADE CÂMARA CASCUDO Desconto nos cursos disponibilizados.<br>
    10 SESC Benefícios sociais / Lazer.<br>




@endsection
