<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Associado;
use App\Models\DocumentoAssociado;
use Illuminate\Support\Facades\Storage;


class DocumentoAssociadoController extends Controller
{
    // Criar documento
    public function storeDocumento(Request $request, $id)
    {
        $user = Auth::user();

        if (!$user || !$user->hasRole('admin|moderador')) {
            return redirect()->route('index')->with('error', 'Acesso negado. Você não tem permissão para acessar esta página.');
        }

        if ($request->hasFile('arquivo')) {
            // Se for upload de arquivo
            $request->validate([
                'tipo_documento' => 'required|string|max:50',
                'arquivo' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048', // 2MB max
                'observacao' => 'nullable|string',
            ]);
        } else {
            return redirect()->back()->with('error', 'Arquivo não enviado.')->withInput();
        }

        $associado = Associado::findOrFail($id);

        $path = $request->file('arquivo')->store('documentos', 'public');


        $associado->documentos()->create([
            'tipo_documento' => $request->tipo_documento,
            'arquivo' => $path,
            'status' => 'pendente',
            'observacao' => $request->observacao,
        ]);

        return redirect()->back()->with('success', 'Documento enviado com sucesso!');
    }

    // Atualizar status/observação do documento
    public function updateDocumento(Request $request, $id, $documentoId)
    {
        $user = Auth::user();

        if (!$user || !$user->hasRole('admin|moderador')) {
            return redirect()->route('index')->with('error', 'Acesso negado. Você não tem permissão para acessar esta página.');
        }

        $request->validate([
            'status' => 'required|in:pendente,recebido,rejeitado',
            'observacao' => 'nullable|string',
        ]);

        $documento = DocumentoAssociado::where('associado_id', $id)->findOrFail($documentoId);
        $documento->update($request->only('status', 'observacao'));

        return redirect()->back()->with('success', 'Documento atualizado com sucesso!');
    }

    // Excluir documento
    public function destroyDocumento($associadoId, $documentoId)
    {
        $user = Auth::user();

        if (!$user || !$user->hasRole('admin|moderador')) {
            return redirect()->route('index')->with('error', 'Acesso negado. Você não tem permissão para acessar esta página.');
        }

        // Garante que o documento pertence ao associado
        $documento = DocumentoAssociado::where('associado_id', $associadoId)
            ->where('id', $documentoId)
            ->firstOrFail();

        // Exclui o arquivo físico (se existir)
        if ($documento->arquivo && Storage::disk('public')->exists($documento->arquivo)) {
            Storage::disk('public')->delete($documento->arquivo);
        }

        // Exclui o registro no banco
        $documento->delete();

        return redirect()->back()->with('success', 'Documento excluído com sucesso!');
    }

    public function showDocumento($id, DocumentoAssociado $documento)
    {

        $user = Auth::user();

        if(!$user || !$user->hasRole('admin|moderador')){
            return redirect()->route('index')->with('error', 'Acesso negado. Voce nao tem permissao para acessar esta página');
        }

        if ($documento->associado_id != $id) {
            abort(404, 'Documento não encontrado para esse associado!');
        }

        // Verifica se existe arquivo físico
        if ($documento->arquivo && Storage::disk('public')->exists($documento->arquivo)) {
            $path = Storage::disk('public')->path($documento->arquivo);

            return response()->file($path); // Abre direto no navegador
        }

        abort(404, 'Arquivo não encontrado.');
    }
}
