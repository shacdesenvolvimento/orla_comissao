<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes= Clientes::all();

        //Gate::authorize('acesso-restrito');
        return view('clientes.clientes',compact('clientes'));
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

         
        $nome= $request->nome;
        $RazaoSocial= $request->RazaoSocial;
        $CNPJ= $request->CNPJ;
        $Contato= $request->Contato;

         Clientes::create(
        ['nome'=>$nome,
        'RazaoSocial'=>$RazaoSocial,
        'CNPJ'=>$CNPJ,
        'Contato'=>$Contato]);
        return redirect()->back()->with('success', 'Cliente cadastrado com sucesso!');        




    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function show(Clientes $clientes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function edit(Clientes $clientes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $id= $request->input('id');
        $nome= $request->input('nome');
        $RazaoSocial= $request->input('RazaoSocial');
        $CNPJ= $request->input('CNPJ');
        $Contato= $request->input('Contato');

        $cliente= Clientes::findOrFail($id);
        $cliente->nome= $nome;
        $cliente->RazaoSocial= $RazaoSocial;
        $cliente->CNPJ= $CNPJ;
        $cliente->Contato= $Contato;
        $cliente->save();
        return redirect()->back()->with('success', 'Cliente Atualizado com sucesso!');
        

       /*  $id= $request->input('id');
        $nome= $request->input('nome');
        $cargo= Cargo::findOrFail($id);
        $cargo->nome= $nome;
        $cargo->save();
        return redirect()->back()->with('success', 'Cargo Atualizado com sucesso!'); */


          $nome= $request->nome;
        $RazaoSocial= $request->RazaoSocial;
        $CNPJ= $request->CNPJ;
        $Contato= $request->Contato;


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clientes $id)
    {
        
        $clientes= Clientes::findOrFail($id->id);
        $clientes->delete();
        return redirect()->back()->with('success', 'Cliente excluido com sucesso!');

    }
}
