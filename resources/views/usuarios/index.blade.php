@extends('layouts.main')

@section('title', 'Aspra Associado')

@section('content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Role</th>
            <th>Ação</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->getRoleNames()->join(', ') }}</td>
            <td class="px-3">
                <form action="{{ route('usuarios.updateRole', $user) }}" method="POST">
                    @csrf
                    <select class="form-select" name="role" required>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}" @if($user->hasRole($role->name)) selected @endif>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit">Atualizar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection