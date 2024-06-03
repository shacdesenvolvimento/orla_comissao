<?php

namespace App\Http\Controllers;

use App\Models\PagamentoporContrato;
use Illuminate\Http\Request;
use App\Models\Cargo;
use App\Models\Clientes;
use App\Models\Contrato;
use App\Models\regra_por_contrato;
use App\Models\RegraComissao;
use App\Models\Unidade;
use App\Models\User;
use App\Models\Produto;
use App\Models\ComissaoPagarVendedor;
use App\Models\ComissaoPagarLider;
use App\Models\ComissaoporContrato;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PagamentoporContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //INFO ABOU CONTRACT
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
        //$contratos = Contrato::leftJoin('regra_por_contratos', 'contratos.id', '=', 'regra_por_contratos.id_contrato')
        //->select('contratos.*', 'regra_por_contratos.permissao_comissao as permissao_comissao')->where('contratos.id','=',$id)->orderBy('contratos.id')
        //->get();
        //dd($contratos);
       

        $contratos = Contrato::leftJoin('regra_por_contratos', 'contratos.id', '=', 'regra_por_contratos.id_contrato')
    ->select('contratos.*', 'regra_por_contratos.permissao_comissao as permissao_comissao')
    ->find($id);
    

   // dd($contratos);

        //PRODUTOS
        //$idprodutoContrato= $contratos->first()->id_produto;
        $idprodutoContrato= $contratos->id_produto;
        //echo $idprodutoContrato;die();
       // $produtos = Produto::where('id', $idprodutoContrato)->select();
        $produtos  = Produto::where('id', $idprodutoContrato)->first();
        //dd($idprodutoContrato);
        //UNIDADES
        //$idunidadeContrato= $contratos->first()->id_unidade;
        $idunidadeContrato= $contratos->id_unidade;
        $unidades = Unidade::where('id', $idunidadeContrato)->first();
        //VENDEDOR
        //$idvendedorContrato= $contratos->first()->id_vendedor;
        $idvendedorContrato= $contratos->id_vendedor;
        $vendedors = User::where('id', $idvendedorContrato)->first();
        //CLIENTE
        //$idclienteContrato= $contratos->first()->id_cliente;
        $idclienteContrato= $contratos->id_cliente;
        $clientes = Clientes::where('id', $idclienteContrato)->first();

        //DADOS
       /*  $valor_contrato=$contratos->first()->valor_contrato;
        $inicio_contrato=$contratos->first()->inicio_contrato;
        $primeiro_pagamento=$contratos->first()->primeiro_pagamento;
        $quant_meses=$contratos->first()->quant_meses;
        $forma_pagamento=$contratos->first()->forma_pagamento;
        $parcelas=$contratos->first()->parcelas;
        $id_regra=$contratos->first()->id_regra; */
        $valor_contrato=$contratos->valor_contrato;
        $inicio_contrato=$contratos->inicio_contrato;
        $primeiro_pagamento=$contratos->primeiro_pagamento;
        $quant_meses=$contratos->quant_meses;
        $forma_pagamento=$contratos->forma_pagamento;
        $parcelas=$contratos->parcelas;
        $id_regra=$contratos->id_regra;
        //DADOS
        
        //INFO ABOU PAY
        $pagamentoPorContrato = PagamentoporContrato::select('*')->where('id_contrato', '=', $id)->get();
        //dd($pagamentoPorContrato);

       
       
        return view('financeiros.controle_por_contrato', compact('contratos', 'produtos','unidades','vendedors','clientes','valor_contrato', 'inicio_contrato', 'primeiro_pagamento', 'quant_meses', 'forma_pagamento', 'parcelas', 'id_regra','pagamentoPorContrato'));
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
       $pagamentoporcontrato= new PagamentoporContrato;
       $id_contrato= $request->input('id_contrato');
       $valor_parcela= $request->input('valor_parcela');
       $id_vendedor= $request->input('id_vendedor');
       $id_lider= $request->input('id_lider');
       //$data_pagamento=date('Y-m-d', strtotime($request->input('data_pagamento'))) ;
       $data_pagamento = Carbon::parse($request->input('data_pagamento'))->toDateString();
       

       $quantParcela = PagamentoporContrato::where('id_contrato', $id_contrato)->count();
       
       

       if($quantParcela==0){
        $quantParcelaAtual=1;
       }else{
        $quantParcelaAtual=$quantParcela+1;
       }


       $ultimoRegistro = PagamentoporContrato::where('id_contrato', $id_contrato)->latest('created_at')->first();
       //dd($ultimoRegistro);
        if ($ultimoRegistro) {
            $totalMomento = $ultimoRegistro->total_atual;
            $total_atual= $totalMomento+$valor_parcela;
        } else {
            $total_atual= $valor_parcela;
        }

       

       $pagamentoporcontrato->id_contrato = $request->input('id_contrato');
       $pagamentoporcontrato->id_vendedor = $request->input('id_vendedor');
       $pagamentoporcontrato->id_lider = $request->input('id_lider');
       $pagamentoporcontrato->valor_parcela = $request->input('valor_parcela');
       $pagamentoporcontrato->data_pagamento = $data_pagamento;
       
       $pagamentoporcontrato->quant_parcela_atual = $quantParcelaAtual;
       $pagamentoporcontrato->total_atual = $total_atual;
       $pagamentoporcontrato->save();
       $id_agamentoporcontrato = $pagamentoporcontrato->id;


       //VERIFICAR E SALVAR PAGAMENTO DE VENDEDOR
       $regra_por_contrato= regra_por_contrato::select('permissao_comissao')->where('id_contrato', '=', $id_contrato)->where('id_vendedor', '=', $id_vendedor)->first();
       
       if($regra_por_contrato->permissao_comissao=='ativo'){
        $porcentagemVendedor= User::select('perc_comissao')->where('id', '=', $id_vendedor)->first();
        $valoreceberVendedor= ($valor_parcela*$porcentagemVendedor->perc_comissao)/100;
        
        $comissao_pagar_vendedor= new ComissaoPagarVendedor;

        
        $comissao_pagar_vendedor->id_pagamentopor_contratos= $id_agamentoporcontrato;
        $comissao_pagar_vendedor->id_contrato= $id_contrato;
        $comissao_pagar_vendedor->id_vendedor= $id_vendedor;
        $comissao_pagar_vendedor->valor_comissao_atual= $valoreceberVendedor;
        $comissao_pagar_vendedor->status= 'pendente';
        $comissao_pagar_vendedor->data_liberacao= $data_pagamento;
        $comissao_pagar_vendedor->save();

       }
       //VERIFICAR E SALVAR PAGAMENTO DE VENDEDOR
       //VERIFICA E SALVAR PAGAMENTO DE LIDER
       

       $regra_por_contratoLider= regra_por_contrato::select('permissao_comissao')->where('id_contrato', '=', $id_contrato)->where('id_lider', '=', $id_lider)->first();
       
       if($regra_por_contratoLider && $regra_por_contratoLider->permissao_comissao=='ativo'){
        $porcentagemVendedor= User::select('perc_comissao')->where('id', '=', $id_lider)->first();
        $valoreceberVendedor= ($valor_parcela*$porcentagemVendedor->perc_comissao)/100;
        
        $comissao_pagar_lider= new ComissaoPagarLider;


        $comissao_pagar_lider->id_pagamentopor_contratos= $id_agamentoporcontrato;
        $comissao_pagar_lider->id_contrato= $id_contrato;
        $comissao_pagar_lider->id_lider= $id_lider;
        $comissao_pagar_lider->valor_comissao_atual= $valoreceberVendedor;
        $comissao_pagar_lider->status= 'pendente';
        $comissao_pagar_lider->data_liberacao= $data_pagamento;
        $comissao_pagar_lider->save();
       }



       return redirect()->back()->with('success', 'Pagamento cadastrado com sucesso!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PagamentoporContrato  $pagamentoporContrato
     * @return \Illuminate\Http\Response
     */
    public function show(PagamentoporContrato $pagamentoporContrato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PagamentoporContrato  $pagamentoporContrato
     * @return \Illuminate\Http\Response
     */
    public function edit(PagamentoporContrato $pagamentoporContrato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PagamentoporContrato  $pagamentoporContrato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PagamentoporContrato $pagamentoporContrato)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PagamentoporContrato  $pagamentoporContrato
     * @return \Illuminate\Http\Response
     */
    public function destroy(PagamentoporContrato $pagamentoporContrato)
    {
        //
    }
}
