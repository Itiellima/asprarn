@extends('layouts.main')

@section('title', '')

@section('content')


    @include('beneficio.form', ['beneficio' => $beneficio])


@endsection
