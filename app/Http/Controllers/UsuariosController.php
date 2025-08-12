<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UsuariosController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user || !$user->hasRole('admin')) {
            return redirect()->route('dashboard')->with('error', 'Acesso negado. Você não tem permissão para acessar esta página.');
        }

        $users = User::all();
        $roles = Role::all();

        return view('usuarios.index', compact('users', 'roles'));
    }

    public function updateRole(Request $request, User $user)
{
    $request->validate([
        'role' => 'required|exists:roles,name',
    ]);

    // Atualiza a role do usuário, removendo as antigas
    $user->syncRoles([$request->role]);

    return redirect()->route('usuarios.index')->with('success', 'Role atualizada com sucesso!');
}
}
