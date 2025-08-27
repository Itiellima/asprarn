<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BeneficioController extends Controller
{
    public function index(){
        return view('beneficio.index');
    }

    public function create(){
        return view('beneficio.create');
    }
}
