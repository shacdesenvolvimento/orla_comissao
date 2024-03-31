<?php

namespace App\Http\Controllers;

use App\Models\ComissaoPagarLider;
use Illuminate\Http\Request;

class ComissaoPagarLiderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Pagarlider= ComissaoPagarLider::all();
        return view('financeiros.comissao_pagar_lider',compact('Pagarlider'));
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
     * @param  \App\Models\ComissaoPagarLider  $comissaoPagarLider
     * @return \Illuminate\Http\Response
     */
    public function show(ComissaoPagarLider $comissaoPagarLider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ComissaoPagarLider  $comissaoPagarLider
     * @return \Illuminate\Http\Response
     */
    public function edit(ComissaoPagarLider $comissaoPagarLider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ComissaoPagarLider  $comissaoPagarLider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ComissaoPagarLider $comissaoPagarLider)
    {
        $id= $request->id;
        
        $pagalider= ComissaoPagarLider::findOrFail($id); 
         
        $pagalider->status= 'pago';
        $pagalider->save();
        return redirect()->back()->with('success','Pagamento realizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ComissaoPagarLider  $comissaoPagarLider
     * @return \Illuminate\Http\Response
     */
    public function destroy(ComissaoPagarLider $comissaoPagarLider)
    {
        //
    }
}
