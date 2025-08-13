<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssociadoController;
use App\Http\Controllers\UsuariosController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/associado', [AssociadoController::class, 'index'])->name('associado.index');
//FORMULARIO de criação de novo associado
Route::get('/associado/create', [AssociadoController::class, 'create'])->name('associado.create');
//ROTA para salvar
Route::post('/associado/store', [AssociadoController::class, 'store'])->name('associado.store');
//ROTA excluir
Route::delete('/associado/delete/{id}', [AssociadoController::class, 'destroy'])->name('associado.destroy');

Route::get('/associado/documentos/{id}', [AssociadoController::class, 'indexDocumentos'])->name('associado.documentos.index');


Route::prefix('associados/{associado}')->group(function () {
    Route::post('/documentos', [AssociadoController::class, 'storeDocumento'])->name('associado.documentos.store');
    Route::patch('/documentos/{documento}', [AssociadoController::class, 'updateDocumento'])->name('associado.documentos.update');
    Route::delete('/documentos/{documento}', [AssociadoController::class, 'destroyDocumento'])->name('associado.documentos.destroy');
});



// Admin routes
Route::middleware(['auth'])->group(function () {
    // ASSOCIADOS
    //FORMULARIO de edição
    Route::get('/associado/edit/{id}', [AssociadoController::class, 'edit'])->name('associado.edit');
    //ROTA editar
    Route::put('/associado/update/{id}', [AssociadoController::class, 'update'])->name('associado.update');
    //ROTA visualizar associado
    Route::get('/associado/show/{id}', [AssociadoController::class, 'show'])->name('associado.show');



    Route::get('/usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');
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
