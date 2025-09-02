<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Associado;
use App\Models\File; // novo model polimórfico
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DocumentoAssociadoController extends Controller
{

    public function indexDocumento($id){

        $user = Auth::user();

        if(!$user || !$user->hasAnyRole(['admin', 'moderador'])){
            return redirect()->route('index')->with('error', 'Acesso negado. Você não tem permissão para acessar esta página.');
        }

        $associado = Associado::with([
            'files'
        ])->findOrFail($id);

        return view('associado.documentos.index', compact('associado'));
    }

    // Criar documento
    public function storeDocumento(Request $request, $id)
    {
        $user = Auth::user();

        if (!$user || !$user->hasAnyRole(['admin', 'moderador'])) {
            return redirect()->route('index')->with('error', 'Acesso negado. Você não tem permissão para acessar esta página.');
        }

        $request->validate([
            'tipo_documento' => 'required|string|max:50',
            'arquivo' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'observacao' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $associado = Associado::findOrFail($id);

            $path = $request->file('arquivo')->store('documentos', 'public');

            $associado->files()->create([
                'tipo_documento' => $request->tipo_documento,
                'path' => $path,
                'status' => 'pendente',
                'observacao' => $request->observacao,
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Documento enviado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao enviar documentos' . $e->getMessage());

            return redirect()->back()->with('error', 'Ocorreu um erro ao enviar os arquivos, tente novamente');
        }
    }

    // Atualizar status/observação
    public function updateDocumento(Request $request, $id, $fileId)
    {
        $user = Auth::user();

        if (!$user || !$user->hasAnyRole(['admin', 'moderador'])) {
            return redirect()->route('index')->with('error', 'Acesso negado. Você não tem permissão para acessar esta página.');
        }

        $request->validate([
            'status' => 'required|in:pendente,recebido,rejeitado',
            'observacao' => 'nullable|string',
        ]);

        $file = File::where('fileable_type', Associado::class)
            ->where('fileable_id', $id)
            ->findOrFail($fileId);

        $file->update($request->only('status', 'observacao'));

        return redirect()->back()->with('success', 'Documento atualizado com sucesso!');
    }

    // Excluir documento
    public function destroyDocumento($associadoId, $fileId)
    {
        $user = Auth::user();

        if (!$user || !$user->hasAnyRole(['admin', 'moderador'])) {
            return redirect()->route('index')->with('error', 'Acesso negado. Você não tem permissão para acessar esta página.');
        }

        $file = File::where('fileable_type', Associado::class)
            ->where('fileable_id', $associadoId)
            ->findOrFail($fileId);

        if ($file->path && Storage::disk('public')->exists($file->path)) {
            Storage::disk('public')->delete($file->path);
        }

        $file->delete();

        return redirect()->back()->with('success', 'Documento excluído com sucesso!');
    }

    // Exibir documento
    public function showDocumento($id, $fileId)
    {
        $user = Auth::user();

        if (!$user || !$user->hasAnyRole(['admin', 'moderador'])) {
            return redirect()->route('index')->with('error', 'Acesso negado. Você não tem permissão para acessar esta página.');
        }

        $file = File::where('fileable_type', Associado::class)
            ->where('fileable_id', $id)
            ->findOrFail($fileId);

        if ($file->path && Storage::disk('public')->exists($file->path)) {
            return response()->file(Storage::disk('public')->path($file->path));
        }

        abort(404, 'Arquivo não encontrado.');
    }
}
