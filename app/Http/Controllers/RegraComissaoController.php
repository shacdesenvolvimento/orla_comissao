<?php

namespace App\Http\Controllers;

use App\Models\RegraComissao;
use Illuminate\Http\Request;

class RegraComissaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regras= RegraComissao::all();
        return view('regras.regras', compact('regras'));
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
        $nome= $request->nome;
        $quant_meses= $request->quant_meses;
        $valor_minimo= $request->valor_minimo;

        $regra= RegraComissao::create([
            'nome'=> $nome,
            'quant_meses'=> $quant_meses,
            'valor_minimo'=> $valor_minimo
        ]);
        return redirect()->back()->with('success', 'Regra cadastrado com sucesso!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RegraComissao  $regraComissao
     * @return \Illuminate\Http\Response
     */
    public function show(RegraComissao $regraComissao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RegraComissao  $regraComissao
     * @return \Illuminate\Http\Response
     */
    public function edit(RegraComissao $regraComissao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RegraComissao  $regraComissao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id= $request->id;
        
        $regraComissao= RegraComissao::findOrFail($id); 
        $nome= $request->nome;
        $quant_meses= $request->quant_meses;
        $valor_minimo= $request->valor_minimo;

        $regraComissao->nome= $nome;
        $regraComissao->quant_meses= $quant_meses;
        $regraComissao->valor_minimo= $valor_minimo;
        $regraComissao->save();
        return redirect()->back()->with('success','Dados Alterado com sucesso');

    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RegraComissao  $regraComissao
     * @return \Illuminate\Http\Response
     */
    public function destroy(RegraComissao $id)
    {
        $regra= RegraComissao::findOrFail($id->id);
        $regra->delete();
        return redirect()->back()->with('success','Regra deletado com sucesso');
    }
}
