<?php

use App\Http\Controllers\CargoController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ComissaoPagarVendedorController;
use App\Http\Controllers\ComissaoporContratoController;
use App\Http\Controllers\ComissaoPagarLiderController;

use App\Http\Controllers\ContratoController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\RegraComissaoController;
use App\Http\Controllers\UnidadeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PagamentoporContratoController;
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

//CARGOS
Route::get('/', [ContratoController::class,'inicio'])->name('inicio');
Route::get('/cargos',[CargoController::class,'index'])->name('cargos');
Route::post('/cargos/inserir',[CargoController::class,'store'])->name('inserir_cargo');
Route::delete('/cargos/{id}/delete',[CargoController::class,'destroy'])->name('cargos.destroy');
Route::post('/cargos/update',[CargoController::class,'update'])->name('cargos.update');


//CLIENTES
Route::get('/clientes',[ClientesController::class,'index'])->name('clientes');
Route::post('/clientes/inserir',[ClientesController::class,'store'])->name('inserir_cliente');
Route::post('/clientes/update',[ClientesController::class,'update'])->name('clientes.update');
Route::delete('/clientes/{id}/delete',[ClientesController::class,'destroy'])->name('clientes.destroy');


//FUNCIONARIOS
Route::get('/funcionarios',[UserController::class,'index'])->name('funcionarios');
Route::post('/funcionarios/inserir',[UserController::class,'store'])->name('inserir.funcionario');
Route::post('/funcionarios/update',[UserController::class,'update'])->name('funcionarios.update');
Route::delete('/funcionarios/{id}/delete',[UserController::class,'destroy'])->name('funcionarios.destroy');


//REGRAS
Route::get('/regras',[RegraComissaoController::class,'index'])->name('regras');
Route::post('/regras/inserir',[RegraComissaoController::class,'store'])->name('inserir.regra');
Route::post('/regras/update',[RegraComissaoController::class,'update'])->name('regras.update');
Route::delete('/regras/{id}/delete',[RegraComissaoController::class,'destroy'])->name('regras.destroy');

//UNIDADES
Route::get('/unidades',[UnidadeController::class,'index'])->name('unidades');
Route::post('/unidades/inserir',[UnidadeController::class,'store'])->name('inserir.unidade');
Route::post('/unidades/update',[UnidadeController::class,'update'])->name('unidades.update');
Route::delete('/unidades/{id}/delete',[UnidadeController::class,'destroy'])->name('unidades.destroy');


//PRODUTOS
Route::get('/produtos',[ProdutoController::class,'index'])->name('produtos');
Route::post('/produtos/inserir',[ProdutoController::class,'store'])->name('inserir.produto');
Route::post('/produtos/update',[ProdutoController::class,'update'])->name('produtos.update');
Route::delete('/produtos/{id}/delete',[ProdutoController::class,'destroy'])->name('produtos.destroy');

//CONTRATO
Route::get('/contrato',[ContratoController::class,'index'])->name('contratos');
Route::post('/contrato/inserir',[ContratoController::class,'store'])->name('inserir.contrato');
Route::post('/contrato/update',[ContratoController::class,'update'])->name('contrato.update');
Route::delete('/contratos/{id}/delete',[ContratoController::class,'destroy'])->name('contratos.destroy');
Route::delete('/contratos/{id}/delete',[ContratoController::class,'destroy'])->name('contratos.destroy');
Route::get('/contrato',[ContratoController::class,'index'])->name('contratos');

//FINANCEIRO
Route::get('/comissaoporpagamento',[ComissaoporContratoController::class,'index'])->name('comissaoporpagamento');
Route::get('/controleporcontrato/{id}',[PagamentoporContratoController::class,'controleporcontrato'])->name('controleporcontrato.show');
Route::post('/controleporcontrato/inserir',[PagamentoporContratoController::class,'store'])->name('inserir.controleporcontrato');

//CONTROLE VENDEDOR
Route::get('/pagarvendedor',[ComissaoPagarVendedorController::class,'index'])->name('pagarvendedor');
Route::post('/pagarvendedor/update',[ComissaoPagarVendedorController::class,'update'])->name('pagarvendedor.update');


//CONTROLE LIDER
Route::get('/pagarlider',[ComissaoPagarLiderController::class,'index'])->name('pagarlider');
Route::post('/pagarlider/update',[ComissaoPagarLiderController::class,'update'])->name('pagarlider.update');