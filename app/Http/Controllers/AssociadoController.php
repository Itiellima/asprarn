<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Associado;

class AssociadoController extends Controller
{
    // listar todos os associados
    public function index()
    {
        $associados = Associado::all();

        return view('associado.index', ['associados' => $associados]);
    }

    // pagina para criar um associado
    public function create(){

        return view('associado.create');
    }

    // salvar o associado no banco de dados
    public function store(Request $request){
        $associado = new Associado();

        $associado->nome = $request->nome;
        $associado->cpf = $request->cpf;
        $associado->data_nascimento = $request->data_nascimento;
        $associado->cidade = $request->cidade;
        $associado->save();

        return redirect('/associado')->with('msg', 'Associado criado com sucesso!');
        
    }

    // exibir detalhes de um associado, busca pelo id.
    public function show($id){

        $associado = Associado::findOrFail($id);
        
        return view('associado.show', ['associado' => $associado]);
    }

}
