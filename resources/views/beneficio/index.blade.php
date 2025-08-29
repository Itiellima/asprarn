@extends('layouts.main')

@section('title', '')

@section('content')

    <div class="meu-container mb-3">
        <h1>Clubes de Beneficios</h1>
    </div>
    @auth
        @hasanyrole(['admin', 'moderador'])
            <div>
                <a href="{{ route('beneficio.create') }}" class="btn btn-success">Adicionar beneficio</a>
            </div>
        @endhasanyrole
    @endauth


    <div class="meu-container row">

        @if (!$beneficios)
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
        @else
            @foreach ($beneficios as $beneficio)
                <div class="card mx-2 mb-3" style="width: 18rem; min-height: 400px;">
                    <div id="carouselExample" class="carousel slide">
                        <div class="carousel-inner">
                            @foreach ($beneficio->files as $index => $files)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/' . $files->path) }}" class="card-img-top mt-2"
                                        alt="{{ $files->path }}" style="height: 180px; object-fit: cover;">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>


                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="card-title">{{ $beneficio->nome }}</h5>
                            <p class="card-text">{{ $beneficio->descricao }}.</p>
                        </div>
                        <div>
                            <a href="#" class="btn btn-primary">Ver mais</a>
                            @auth
                                @hasanyrole(['admin', 'moderador'])
                                    <a href="#" class="btn btn-danger ms-2">Excluir</a>
                                @endhasanyrole
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        @endif




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
