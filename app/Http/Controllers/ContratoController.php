<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Clientes;
use App\Models\Contrato;
use App\Models\regra_por_contrato;
use App\Models\RegraComissao;
use App\Models\Unidade;
use App\Models\User;
use App\Models\Produto;
use App\Models\VendedorPorLiderr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function inicio (){
        return view('layouts.layouts');
    }
     public function index()
    {
        $contratos = Contrato::leftJoin('regra_por_contratos', 'contratos.id', '=', 'regra_por_contratos.id_contrato')
        ->select('contratos.*', 'regra_por_contratos.permissao_comissao as permissao_comissao')->orderBy('contratos.id')
        ->get();
        //$contratos= Contrato::all();
        $produtos= Produto::all();
        $unidades= Unidade::all();
        $vendedors= User::where('id_cargo', 2)->get();
        $liders= User::where('id_cargo', 1)->get();
        $clientes= Clientes::all();



       
        return view('contratos.contratos', compact('contratos', 'produtos','unidades','vendedors','clientes','liders'));
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $contrato = new Contrato;

        $contrato->id_produto = $request->input('id_produto');
        $contrato->id_unidade = $request->input('id_unidade');
        $contrato->id_vendedor = $request->input('id_vendedor');
        $contrato->id_cliente = $request->input('id_cliente');
        $contrato->forma_pagamento = $request->input('forma_pagamento');
        $contrato->parcelas = $request->input('parcelas');
        
        $contrato->valor_contrato = $request->valor_contrato;
        $contrato->inicio_contrato = $request->inicio_contrato;
        $contrato->primeiro_pagamento = $request->primeiro_pagamento;
        $contrato->quant_meses = $request->quant_meses;
        
       /*  echo $request->input('id_produto');
        die(); */
        //PEGAR LIDER
        $id_lider = VendedorPorLiderr::where('id_vendedor', $request->input('id_vendedor'))->select('id_lider')->first()->id_lider;
        
        $contrato->id_lider=$id_lider;
        //REGRA DO PRODUTO
        $Idregra_produto = Produto::find($contrato->id_produto);

        //id da regra SALVAR
        $Idregra = $Idregra_produto->id_regra;
        $contrato->id_regra = $Idregra;
        $contrato->save();
        //id do lider
        //$id_lider = VendedorPorLiderr::find($contrato->id_vendedor);
        
        //id contrato inserido
        $id_contrato= $contrato->id;

        //VALORES DA REGRA POR ID
        $valores_regra= RegraComissao::find($Idregra);
        $quant_meses= $valores_regra->quant_meses;
        $valor_minimo=$valores_regra-> valor_minimo;

        //VERIFICAR VALORES COM A REGRA DE COMISSÃO

        if($contrato->valor_contrato >=$valor_minimo && $contrato->quant_meses>= $quant_meses){
            $status_comissao='ativo';
        }else{
            $status_comissao='inativo';
        }

        $regraPorContrato= new regra_por_contrato;
        $regraPorContrato->id_contrato= $id_contrato;
        $regraPorContrato->id_regra= $Idregra;
        $regraPorContrato->id_vendedor= $contrato->id_vendedor;
        $regraPorContrato->permissao_comissao=$status_comissao;
        $regraPorContrato->save();



        return redirect()->back()->with('success', 'Contrato cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function show(Contrato $contrato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function edit(Contrato $contrato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    
    {
        $id= $request->id;
        
        
        $contrato = Contrato::findOrFail($id);

        
        $contrato->id_produto = $request->input('id_produto', $contrato->id_produto);
        $contrato->id_unidade = $request->input('id_unidade', $contrato->id_unidade);
        $contrato->id_vendedor = $request->input('id_vendedor', $contrato->id_vendedor);
        $contrato->id_cliente = $request->input('id_cliente', $contrato->id_cliente);
        $contrato->valor_contrato = $request->input('valor_contrato', $contrato->valor_contrato);
        $contrato->inicio_contrato = $request->input('inicio_contrato', $contrato->inicio_contrato);
        $contrato->primeiro_pagamento = $request->input('primeiro_pagamento', $contrato->primeiro_pagamento);
        $contrato->quant_meses = $request->input('quant_meses', $contrato->quant_meses);
        $contrato->id_regra = $request->input('id_regra', $contrato->id_regra);



        $contrato->save();
        return redirect()->back()->with('success','Dados Alterado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contrato $id)
    {
        $contrato= Contrato::findOrFail($id->$id);
        $contrato->delete();
        return redirect()->back()->with('success','Unidade deletado com sucesso');   
    }
}
