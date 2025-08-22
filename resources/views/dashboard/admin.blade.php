@extends('layouts.main')

@section('title', '')

@section('content')

@include('layouts.nav-dashboard')
    <body class="">

        <!-- Conteúdo -->
        <main class="flex-1 p-6">
            <h2 class="text-2xl font-bold">Conteúdo principal</h2>
            <p class="mt-4">Texto de exemplo dentro da área principal.</p>
            <div class="container">

            </div>

            @auth
                <p>Bem vindo: <strong>{{ auth()->user()->name }}</strong></p>
                @hasanyrole('admin|moderador|associado|user')
                    <p><strong>Any Role</strong></p>
                @endhasanyrole

                @role('admin')
                    <p><strong>ADMINISTRADOR</strong></p>
                @endrole

                @role('moderador')
                    <p><strong>MODERADOR</strong></p>
                @endrole

                @role('associado')
                    <p><strong>ASSOCIADO</strong></p>
                @endrole

                @role('user')
                    <p><strong>USUÁRIO</strong></p>
                @endrole
            @endauth

        </main>

    </body>

@endsection
