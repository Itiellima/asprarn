<?php

namespace App\Http\Controllers;

use App\Models\PastaDocumento;
use App\Models\Associado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PastaDocumentoController extends Controller
{
    public function index($id)
    {
        $user = Auth::user();
        if (!$user || !$user->hasAnyRole(['admin', 'moderador'])) {
            return redirect()->route('index')->with('error', 'Acesso negado. Você não tem permissão para acessar esta página.');
        }


        $associado = Associado::findOrFail($id);
        $pastas = $associado->pastaDocumentos()->paginate(10);

        return view('associado.pastas.index', compact('associado', 'pastas'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request, $id)
    {
        $user = Auth::user();
        if (!$user || !$user->hasAnyRole(['admin', 'moderador'])) {
            return redirect()->route('index')->with('error', 'Acesso negado.');
        }

        $associado = Associado::findOrFail($id);

        $request->validate([
            'nome' => 'required|string|max:255',
            'tipo_documento' => 'nullable|string|max:100',
            'descricao' => 'nullable|string',
        ]);

        $associado->pastaDocumentos()->create([
            'nome' => $request->nome,
            'tipo_documento' => $request->tipo_documento,
            'descricao' => $request->descricao,
        ]);

        return redirect()->back()->with('success', 'Pasta de documentos criada com sucesso.');
        //
    }

    public function show($associado_id, $pasta_id)
    {
        $user = Auth::user();
        if (!$user || !$user->hasAnyRole(['admin', 'moderador'])) {
            return redirect()->route('index')->with('error', 'Acesso negado. Você não tem permissão para acessar esta página.');
        }

        $associado = Associado::findOrFail($associado_id);
        $pasta = $associado->pastaDocumentos()->with('files')->findOrFail($pasta_id);

        return view('associado.pastas.show', compact('pasta', 'associado'));
    }
}
