<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MarcaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*=== CATEGORÍA ===*/
Route::post('/categoria/setRegistrarCategoria', [CategoriaController::class, 'setRegistrarCategoria']);
Route::get('/categoria/getListarCategoria', [CategoriaController::class, 'getListarCategoria']);
Route::post('/categoria/editCategoria/{id}', [CategoriaController::class, 'editCategoria']);
Route::delete('/categoria/delCategoria/{id}', [CategoriaController::class, 'delCategoria']);

/*=== MARCA ===*/
Route::post('/marca/setRegistrarMarca', [MarcaController::class, 'setRegistrarMarca']);
Route::get('/marca/getListarMarca', [MarcaController::class, 'getListarMarca']);
Route::post('/marca/editMarca/{id}', [MarcaController::class, 'editMarca']);
Route::delete('/marca/delMarca/{id}', [MarcaController::class, 'delMarca']);


/*=== CLIENTES ===*/
Route::get('/cliente/getListarClientes', [ClienteController::class, 'getListarClientes']);
Route::get('/cliente/getListarPorCliente/{id}', [ClienteController::class, 'getDatosPorCliente']);
Route::post('/cliente/setRegistrarCliente', [ClienteController::class, 'setRegistrarCliente']);
Route::delete('/cliente/delCliente/{id}', [ClienteController::class, 'delCliente']);
Route::post('/cliente/cambiarEstadoCliente/{id}', [ClienteController::class, 'cambiarEstadoCliente']);
Route::post('/cliente/editCliente/{id}', [ClienteController::class, 'editCliente']);



Route::get('/{any}', function () {
    return view('plantilla');
})->name('basepath')
->where('any','.*');

