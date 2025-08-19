<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssociadoController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\DocumentoAssociadoController;
use App\Http\Controllers\HistoricoSituacoesController;
use App\Http\Controllers\RequerimentoController;
use App\Http\Controllers\SituacaoController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/requerimento', function () {
    return view('/associado/pdf/requerimento');
});

Route::get('/requerimento/{id}', [RequerimentoController::class, 'show'])->name('associado.pdf.requerimento');


Route::get('/associado', [AssociadoController::class, 'index'])->name('associado.index');
//FORMULARIO de criação de novo associado
Route::get('/associado/create', [AssociadoController::class, 'create'])->name('associado.create');
//ROTA para salvar
Route::post('/associado/store', [AssociadoController::class, 'store'])->name('associado.store');
//ROTA excluir
Route::delete('/associado/delete/{id}', [AssociadoController::class, 'destroy'])->name('associado.destroy');


// Show Associado
Route::get('/associado/documentos/{id}', [AssociadoController::class, 'indexDocumentos'])->name('associado.documentos.index');


// Rota Salvar Documento
Route::post('/associado/{id}/documentos', [DocumentoAssociadoController::class, 'storeDocumento'])->name('associado.documentos.store');
// Rota de edição
Route::patch('/associado/{id}/documentos/{documento}', [DocumentoAssociadoController::class, 'updateDocumento'])->name('associado.documentos.update');
// Rota Delete
Route::delete('/associado/{id}/documentos/{documento}', [DocumentoAssociadoController::class, 'destroyDocumento'])->name('associado.documentos.destroy');
// Visualizar documentos
Route::get('/associado/documentos/{id}/{documento}', [DocumentoAssociadoController::class, 'showDocumento'])->name('associado.documentos.show');

Route::post('/associado/situacao/{id}', [SituacaoController::class, 'storeSituacao'])->name('associado.situacao.store');


Route::post('/associado/{id}/historico', [HistoricoSituacoesController::class, 'storeHistorico'])->name('associado.historico.store');
Route::delete('/associado/{id}/historico/{historico}', [HistoricoSituacoesController::class, 'destroyHistorico'])->name('associado.historico.destroy');

// Admin routes
Route::middleware(['auth'])->group(function () {
    // ASSOCIADOS
    //FORMULARIO de edição
    Route::get('/associado/edit/{id}', [AssociadoController::class, 'edit'])->name('associado.edit');
    //ROTA editar
    Route::put('/associado/update/{id}', [AssociadoController::class, 'update'])->name('associado.update');
    //ROTA visualizar associado
    Route::get('/associado/show/{id}', [AssociadoController::class, 'show'])->name('associado.show');
    // View usuarios
    Route::get('/usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');
    // Rota para atualizar as permissoes de um usuario
    Route::post('/usuarios/{user}/role', [UsuariosController::class, 'updateRole'])->name('usuarios.updateRole');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
