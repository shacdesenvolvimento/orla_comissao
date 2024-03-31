<?php

namespace App\Http\Controllers;

use App\Models\ComissaoporContrato;
use Illuminate\Http\Request;
use App\Models\Cargo;
use App\Models\Clientes;
use App\Models\Contrato;
use App\Models\regra_por_contrato;
use App\Models\RegraComissao;
use App\Models\Unidade;
use App\Models\User;
use App\Models\Produto;
use Illuminate\Support\Facades\DB;

class ComissaoporContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $contratos = Contrato::leftJoin('regra_por_contratos', 'contratos.id', '=', 'regra_por_contratos.id_contrato')
        ->select('contratos.*', 'regra_por_contratos.permissao_comissao as permissao_comissao')->orderBy('contratos.id')
        ->get();
        //$contratos= Contrato::all();
        $produtos= Produto::all();
        $unidades= Unidade::all();
        $vendedors= User::all();
        $clientes= Clientes::all();



       
        return view('financeiros.controle_pagamento', compact('contratos', 'produtos','unidades','vendedors','clientes'));
    }
    public function controleporcontrato($id)
    {
        $contratos = Contrato::leftJoin('regra_por_contratos', 'contratos.id', '=', 'regra_por_contratos.id_contrato')
        ->select('contratos.*', 'regra_por_contratos.permissao_comissao as permissao_comissao')->where('contratos.id','=',$id)->orderBy('contratos.id')
        ->get();
        //dd($contratos);
        //$contratos= Contrato::all();
        $produtos= Produto::all();
        $unidades= Unidade::all();
        $vendedors= User::all();
        $clientes= Clientes::all();



       
        return view('financeiros.controle_por_contrato', compact('contratos', 'produtos','unidades','vendedors','clientes'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ComissaoporContrato  $comissaoporContrato
     * @return \Illuminate\Http\Response
     */
    public function show(ComissaoporContrato $comissaoporContrato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ComissaoporContrato  $comissaoporContrato
     * @return \Illuminate\Http\Response
     */
    public function edit(ComissaoporContrato $comissaoporContrato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ComissaoporContrato  $comissaoporContrato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ComissaoporContrato $comissaoporContrato)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ComissaoporContrato  $comissaoporContrato
     * @return \Illuminate\Http\Response
     */
    public function destroy(ComissaoporContrato $comissaoporContrato)
    {
        //
    }
}
