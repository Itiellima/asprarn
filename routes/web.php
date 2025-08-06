<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssociadoController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/associado' , [AssociadoController::class, 'index']);
Route::get('/associado/create', [AssociadoController::class, 'create']);
Route::post('/associado/store', [AssociadoController::class, 'store']);
Route::get('/associado/{id?}', [AssociadoController::class, 'show']);