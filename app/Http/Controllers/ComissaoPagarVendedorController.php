<?php

namespace App\Http\Controllers;

use App\Models\ComissaoPagarVendedor;
use Illuminate\Http\Request;

class ComissaoPagarVendedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Pagarvendedor= ComissaoPagarVendedor::all();
        return view('financeiros.comissao_pagar_vendedor',compact('Pagarvendedor'));
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
     * @param  \App\Models\ComissaoPagarVendedor  $comissaoPagarVendedor
     * @return \Illuminate\Http\Response
     */
    public function show(ComissaoPagarVendedor $comissaoPagarVendedor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ComissaoPagarVendedor  $comissaoPagarVendedor
     * @return \Illuminate\Http\Response
     */
    public function edit(ComissaoPagarVendedor $comissaoPagarVendedor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ComissaoPagarVendedor  $comissaoPagarVendedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id= $request->id;
        
        $pagavendedor= ComissaoPagarVendedor::findOrFail($id); 
         
        $pagavendedor->status= 'pago';
        $pagavendedor->save();
        return redirect()->back()->with('success','Pagamento realizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ComissaoPagarVendedor  $comissaoPagarVendedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(ComissaoPagarVendedor $comissaoPagarVendedor)
    {
        //
    }
}
