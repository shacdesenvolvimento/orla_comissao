<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\RegraComissao;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos= Produto::all();
        $regras= RegraComissao::all();
        return view('produtos.produtos', compact('produtos','regras'));
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
        $id_regra= $request->input('regra');
        


        $produto= Produto::create([
            'nome'=> $nome,
            'id_regra'=> $id_regra,
        ]);
        return redirect()->back()->with('success', 'Produto cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id= $request->id;
        
        $produto= Produto::findOrFail($id); 
        $nome= $request->nome;
        $id_regra= $request->regra;
        $id_regra= $request->input('regra');
        $produto->nome= $nome;
        $produto->id_regra= $id_regra;
        $produto->save();
        return redirect()->back()->with('success','Dados Alterado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $id)
    {
      
        $produto= Produto::findOrFail($id->$id);
        $produto->delete();
        return redirect()->back()->with('success','Unidade deletado com sucesso');
    }
    
}
