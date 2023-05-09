<?php

use App\Http\Controllers\CategoriaController;
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

Route::post('/categoria/setRegistrarCategoria', [CategoriaController::class, 'setRegistrarCategoria']);
Route::get('/categoria/getListarCategoria', [CategoriaController::class, 'getListarCategoria']);
Route::delete('/categoria/delCategoria/{id}', [CategoriaController::class, 'delCategoria']);
Route::post('/categoria/editCategoria/{id}', [CategoriaController::class, 'editCategoria']);


Route::get('/{optional?}', function () {
    return view('plantilla');
})->where('any', '.*');;


