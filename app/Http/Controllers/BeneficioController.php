<?php

namespace App\Http\Controllers;

use App\Models\Beneficio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BeneficioController extends Controller
{
    public function index()
    {

        $beneficios = Beneficio::all();

        return view('beneficio.index', compact('beneficios'));
    }

    public function create()
    {

        $beneficio = new Beneficio();

        return view('beneficio.create', compact('beneficio'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'nome' => 'required',
            'descricao' => 'required',
            'arquivos' => 'required',
        ]);

        $arquivos = $request->file('arquivos');

        DB::beginTransaction();
        try {
            $beneficio = Beneficio::create([
                'nome' => $request->nome,
                'descricao' => $request->descricao,
            ]);

            foreach ($arquivos as $arquivo) {
                $path = $arquivo->store('img', 'public');

                $beneficio->files()->create([
                    'path' => $path,
                    'tipo_documento' => 'imagem',
                    'status' => 'ativo',
                    'observacao' => 'Upload automatico',
                ]);
            }

            DB::commit();

            return redirect('beneficio')->with('success', 'Beneficio criado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect('beneficio')->with('error', 'Erro ao criar beneficio!' . $e->getMessage());
        }
    }
}
