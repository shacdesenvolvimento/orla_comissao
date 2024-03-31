<?php

use App\Http\Controllers\CargoController;
use App\Http\Controllers\ContratoController;
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

/* Route::get('/', function () {
    return view('welcome');
}); */

/* Route::get('/', function(){
    return view('layouts.layouts');
}); */

Route::get('/', [ContratoController::class,'index']);
Route::get('/cargos',[CargoController::class,'index']);
Route::post('/cargos/inserir',[CargoController::class,'store'])->name('inserir_cargo');
Route::delete('/cargos/inserir/{id}',[CargoController::class,'destroy'])->name('cargos.destroy');