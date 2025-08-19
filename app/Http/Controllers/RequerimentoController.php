<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Associado;
use Barryvdh\DomPDF\Facade\Pdf;

class RequerimentoController extends Controller
{
    /* 
    public function gerar($id)
    {
        $associado = Associado::findOrFail($id);

        $pdf = Pdf::loadView('associado.pdf.requerimento', compact('associado'))
                  ->setPaper('a4');

        return $pdf->stream('requerimento_'.$associado->nome.'.pdf');
    }
        */

    public function show($id)
    {
        $associado = Associado::findOrFail($id);

        
        return view('associado.pdf.requerimento', compact('associado'));
    }
}
