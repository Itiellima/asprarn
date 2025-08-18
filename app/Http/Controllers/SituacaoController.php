<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Associado;
use App\Models\Situacao;

class SituacaoController extends Controller
{
    public function storeSituacao(Request $request, $id)
    {

        $user = Auth::user();

        if (!$user || !$user->hasRole('admin|moderador')) {
            return redirect()->route('index')->with('error', 'Acesso nao autorizado');
        }

        $validated = $request->validate([
            'ativo' => 'required|boolean',
            'inadimplente' => 'required|boolean',
            'pendente_documento' => 'required|boolean',
            'pendente_financeiro' => 'required|boolean',
        ]);

        $associado = Associado::findOrFail($id);

        $associado->situacao()->create($validated);

        return redirect()->back()->with('sucess', 'Situação incluida com sucesos');
    }

    public function updateSituacao(Request $request, $id, $situacaoId)
    {

        // Validação
        $validated = $request->validate([
            'ativo' => 'required|boolean',
            'inadimplente' => 'required|boolean',
            'pendente_documento' => 'required|boolean',
            'pendente_financeiro' => 'required|boolean',
        ]);

        // Buscar situação garantindo que pertence ao associado
        $situacao = Situacao::where('associado_id', $id)
            ->where('id', $situacaoId)
            ->firstOrFail();

        // Atualizar
        $situacao->update($validated);

        return redirect()->back()->with('success', 'Situação atualizada com sucesso!');
    }
}
