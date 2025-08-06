<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Associado;

class AssociadoController extends Controller
{
    public function index()
    {
        $associados = Associado::all();

        return view('associado.index', ['associados' => $associados]);
    }

    public function create(){

        return view('associado.create');
    }

    public function store(Request $request){
        $associado = new Associado();

        $associado->nome = $request->nome;
        $associado->data_nascimento = $request->data_nascimento;
        $associado->cidade = $request->cidade;
        $associado->save();

        return redirect('/associado')->with('msg', 'Associado criado com sucesso!');
        
    }

    public function show($id){

        $associado = Associado::findOrFail($id);

        return view('associado.associado', ['id' => $associado->id]);
    }

}
