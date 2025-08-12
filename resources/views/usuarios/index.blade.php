@extends('layouts.main')

@section('title', 'Aspra Associado')

@section('content')

    <div class="container">
        <h1>Gerenciar Roles dos Usuários</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Role Principal</th>
                    <th>Alterar Role</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    @php
                        // Pega a role principal baseado na hierarquia
                        if ($user->hasRole('admin')) {
                            $principal = 'admin';
                        } elseif ($user->hasRole('moderador')) {
                            $principal = 'moderador';
                        } else {
                            $principal = 'user';
                        }
                    @endphp
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($principal) }}</td>
                        <td>
                            <form action="{{ route('usuarios.updateRole', $user->id) }}" method="POST">
                                @csrf
                                <select name="role" class="form-select" required>
                                    <option value="admin" {{ $principal === 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="moderador" {{ $principal === 'moderador' ? 'selected' : '' }}>Moderador
                                    </option>
                                    <option value="user" {{ $principal === 'user' ? 'selected' : '' }}>User</option>
                                </select>
                                <button type="submit" class="btn btn-primary mt-1">Salvar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
