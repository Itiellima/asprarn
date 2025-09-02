<?php

namespace App\Http\Controllers;

use App\Models\Associado;
use App\Models\HistoricoSituacoes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoricoSituacoesController extends Controller
{
    public function storeHistorico(Request $request, $id) {

        $user = Auth::user();

        if(!$user || !$user->hasRole('admin|moderador')){
            return redirect()->route('index')->with('error', 'Acesso não autorizado');
        }

        if($request){
            $request->validate([
                'situacao' => 'required|string|max:50',
                'observacao' => 'nullable|string|max:200',
                'data_inicio' => 'required|date',
                'data_fim' => 'nullable|date',

            ]);
        }else{
            return redirect()->back()->with('error', 'Erro ao inserir um historico')->withInput();
        }

        $associado = Associado::findOrFail($id);

        $associado->historicoSituacoes()->create([
            'situacao' => $request->situacao,
            'observacao' => $request->observacao,
            'data_inicio' => $request->data_inicio,
            'data_fim' => $request->data_fim,
        ]);

        return redirect()->back()->with('success', 'Historico criado com sucesso!');
    }


    public function destroyHistorico($associadoId, $historicoId){

        $user = Auth::user();

        if(!$user || !$user->hasRole('admin|moderador')){
            return redirect()->back()->with('error', 'Acesso negado. Você não tem permissão para acessar esta página.');
        }

        $historico = HistoricoSituacoes::where('associado_id', $associadoId)
            ->where('id', $historicoId)
            ->firstOrFail();

        $historico->delete();

        return redirect()->back()->with('success', 'Historico excluido com sucesso!');
    }

}
