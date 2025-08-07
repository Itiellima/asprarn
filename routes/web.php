<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssociadoController;

Route::get('/', function () {
    return view('welcome');
});

//listar
Route::get('/associado' , [AssociadoController::class, 'index'])->name('associado.index');
//formulario de criação
Route::get('/associado/create', [AssociadoController::class, 'create'])->name('associado.create');
//rota para salvar
Route::post('/associado/store', [AssociadoController::class, 'store'])->name('associado.store');

//formulario de edição
Route::get('/associado/edit/{id}', [AssociadoController::class, 'edit'])->name('associado.edit');
//rota editar
Route::put('/associado/update/{id}', [AssociadoController::class, 'update'])->name('associado.update');


