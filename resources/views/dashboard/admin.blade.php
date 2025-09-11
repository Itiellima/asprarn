@extends('layouts.main')

@section('title', '')

@section('content')


    @include('layouts.nav-dashboard')

    <div class="container text-center justify-content-center">
        <div class="row m-3">
            <div class="card m-2" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Associados cadastrados:</h5>
                    <p class="card-text">Total: {{ count($associados) }}.</p>
                </div>
            </div>

            <div class="card m-2" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Associados Adimplentes:</h5>
                    <p class="card-text">Total: </p>
                </div>
            </div>

            <div class="card m-2" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Associados Inadimplentes:</h5>
                    <p class="card-text">Total: </p>
                </div>
            </div>
        </div>
    </div>

@endsection
