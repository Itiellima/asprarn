<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssociadoController;
use App\Http\Livewire\Auth\Register;

Route::get('/', function () {
    return view('welcome');
});



//verifica se o usuario está logado
Route::middleware(['auth'])->group(function(){
    
});

Route::get('/associado', [AssociadoController::class, 'index'])->name('associado.index');
//FORMULARIO de criação
Route::get('/associado/create', [AssociadoController::class, 'create'])->name('associado.create');
//ROTA para salvar
Route::post('/associado/store', [AssociadoController::class, 'store'])->name('associado.store');
//FORMULARIO de edição
Route::get('/associado/edit/{id}', [AssociadoController::class, 'edit'])->name('associado.edit');
//ROTA editar
Route::put('/associado/update/{id}', [AssociadoController::class, 'update'])->name('associado.update');
//ROTA excluir
Route::delete('/associado/delete/{id}', [AssociadoController::class, 'destroy'])->name('associado.destroy');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

