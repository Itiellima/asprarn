<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Associado;
use App\Models\Contato;
use App\Models\Endereco;
use App\Models\DadosBancarios;
use Illuminate\Support\Facades\Auth;
use App\Models\DocumentoAssociado;
use Illuminate\Support\Facades\Storage;


class AssociadoController extends Controller
{
    // view todos os associados
    public function index()
    {
        $search = request('search');

        $associados = Associado::query()
            ->when($search, function ($query, $search) {
                $query->where('nome', 'like', "%{$search}%")
                    ->orWhere('cpf', 'like', "%{$search}%")
                    ->orWhere('matricula', 'like', "%{$search}%");
            })
            ->orderBy('nome')
            ->paginate(10);


        return view('associado.index', ['associados' => $associados, 'search' => $search]);
    }


    // view detalhes informaçoes
    public function show($id)
    {
        $user = Auth::user();

        if (!$user || !$user->hasRole('admin|moderador')) {
            return redirect()->route('index')->with('error', 'Acesso negado. Você não tem permissão para acessar esta página.');
        }


        $associado = Associado::with([
            'endereco',
            'contato',
            'dadosBancarios',
            'documentos',
            'historicoSituacoes',
            'mensalidades'
        ])->findOrFail($id);

        return view('associado.show', ['associado' => $associado]);
    }

    // view para criar um associado
    public function create()
    {
        $associado = new Associado();

        return view('associado.create', ['associado' => $associado]);
    }

    // Rota salvar o associado no banco de dados
    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user || !$user->hasRole('admin|moderador')) {
            return redirect()->route('associado.create')->with('error', 'Acesso negado. Você não tem permissão para acessar esta página.');
        }

        // Validação dos campos
        if (!\App\Helpers\CpfHelper::validar($request->cpf)) {
            return redirect()->back()->with('error', 'CPF inválido.')->withInput();
        }

        //salva associado
        DB::beginTransaction();
        try {
            $associado = new Associado();
            $associado->nome = $request->nome;
            $associado->cpf = $request->cpf;
            $associado->rg = $request->rg;
            $associado->org_expedidor = $request->org_expedidor;
            $associado->nome_pai = $request->nome_pai;
            $associado->nome_mae = $request->nome_mae;
            $associado->dt_nasc = $request->dt_nasc;
            $associado->estado_civil = $request->estado_civil;
            $associado->grau_instrucao = $request->grau_instrucao;
            $associado->nome_guerra = $request->nome_guerra;
            $associado->nmr_praca = $request->nmr_praca;
            $associado->matricula = $request->matricula;
            $associado->opm = $request->opm;
            $associado->dependentes = $request->dependentes;
            $associado->obs = $request->obs;
            $associado->save();

            $endereco = new Endereco();
            $endereco->cep = $request->cep;
            $endereco->logradouro = $request->logradouro;
            $endereco->nmr = $request->nmr;
            $endereco->bairro = $request->bairro;
            $endereco->cidade = $request->cidade;
            $endereco->uf = $request->uf;
            $endereco->complemento = $request->complemento;
            $endereco->associado_id = $associado->id;
            $endereco->save();

            $contato = new Contato();
            $contato->tel_celular = $request->tel_celular;
            $contato->tel_residencial = $request->tel_residencial;
            $contato->tel_trabalho = $request->tel_trabalho;
            $contato->email = $request->email;
            $contato->associado_id = $associado->id;
            $contato->save();

            $dadosBancarios = new DadosBancarios();
            $dadosBancarios->codigo = $request->codigo;
            $dadosBancarios->agencia = $request->agencia;
            $dadosBancarios->banco = $request->banco;
            $dadosBancarios->conta = $request->conta;
            $dadosBancarios->operacao = $request->operacao;
            $dadosBancarios->tipo = $request->tipo;
            $dadosBancarios->associado_id = $associado->id;
            $dadosBancarios->save();
            DB::commit();
            return redirect('/associado')->with('msg', 'Associado criado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Erro ao criar associado: ' . $e->getMessage())->withInput();
        }
    }

    // view edição do associado
    public function edit($id)
    {
        $user = Auth::user();

        if (!$user || !$user->hasRole('admin|moderador')) {
            return redirect()->route('dashboard')->with('error', 'Acesso negado. Você não tem permissão para acessar esta página.');
        }

        $associado = Associado::findOrFail($id);

        return view('associado.create', ['associado' => $associado]);
    }

    // Rota para atualizar o associado no banco de dados
    public function update(Request $request, $id)
    {
        $user = Auth::user();

        if (!$user || !$user->hasRole('admin|moderador')) {
            return redirect()->route('index')->with('error', 'Acesso negado. Você não tem permissão para acessar esta página.');
        }

        $associado = Associado::with(['endereco', 'contato', 'dadosBancarios'])->findOrFail($id); // encontra o registro pelo ID

        $data = $request->except('_token', '_method'); // limpa dados desnecessários
        $associado->update($data); // atualiza o registro com os dados filtrados

        return redirect('/associado')->with('msg', 'Associado alterado com sucesso!');
    }

    // Deletar associado
    public function destroy($id)
    {
        $user = Auth::user();

        if (!$user || !$user->hasRole('admin|moderador')) {
            return redirect()->route('index')->with('error', 'Acesso negado. Você não tem permissão para acessar esta página.');
        }

        $associado = Associado::findOrFail($id);

        $associado->delete();

        return redirect('/associado')->with('msg', 'Associado deletado com sucesso!');
    }

    ///////////////////////////////////////////// documentos associados \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    
    // Listar documentos
    public function indexDocumentos($id)
    {
        $user = Auth::user();

        if (!$user || !$user->hasRole('admin|moderador')) {
            return redirect()->route('index')->with('error', 'Acesso negado. Você não tem permissão para acessar esta página.');
        }

        $associado = Associado::with('documentos')->findOrFail($id);
        return view('associado.documentos.index', compact('associado'));
    }

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

    public function storeSituacao(Request $request, $id)
    {
        $associado = Associado::findOrFail($id);

        $associado->historicoSituacoes()->create([
            'situacao' => $request->situacao,
            'observacao' =>$request->observacao,
            'data_inicio' =>$request->data_inicio,
            'data_fim' =>$request->data_fim,
        ]);

        return redirect()->back()->with('sucess', 'Nova situação incluida!');
    }
}
