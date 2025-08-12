<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UsuariosController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user || !$user->hasRole('admin')) {
            abort(403, 'Acesso negado. Você precisa ser admin.');
        }

        $users = \App\Models\User::all();

        return view('usuarios.index', compact('users'));
    }
}
