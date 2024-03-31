<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cargo;
use App\Models\VendedorPorLiderr;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $funcionarios= User::all();
        $cargos= Cargo::all();
        $liders= User::where('id_cargo', 1)->get();
        return view('funcionarios.funcionarios',compact('funcionarios', 'cargos','liders'));
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
        $cargo= $request->cargo;
        $cargo = $request->input('cargo');
        $lider= $request->lider;
        $lider = $request->input('lider');
        $email= $request->email;
        $password= $request->password;
        $contato= $request->contato;
        $perc_comissao= $request->perc_comissao;

        $funcionario= User::create(
            [
                'nome'=>$nome,
                'contato'=>$contato,
                'id_cargo'=> $cargo,
                'email'=> $email,
                'password'=> $password,
                'perc_comissao'=> $perc_comissao,
            ]
        );
        $IdVendedorAtual = $funcionario->id;
        if($cargo==2 && $lider==1 ){
            $vendedorPorlider= VendedorPorLiderr::create([
                'id_lider'=>$lider, 
                'id_vendedor'=> $IdVendedorAtual,
            ]);
        }       
        return redirect()->back()->with('success', 'Funcionario cadastrado com sucesso!'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id= $request->input('id');
        $nome= $request->input('nome');
        $cargo = $request->input('cargo');
        $email= $request->input('email');
        $password= $request->input('password');
        $contato= $request->input('contato');
        $perc_comissao= $request->input('perc_comissao');

        $funcionario= User::findOrFail($id);

        $funcionario->nome= $nome;
        $funcionario->id_cargo = $cargo;
        $funcionario->email= $email;
        $funcionario->password= $password;
        $funcionario->contato= $contato;
        $funcionario->perc_comissao= $perc_comissao;

        $funcionario->save();
        return redirect()->back()->with('success','Dados Alterado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $id)
    {
        $funcionario= User::findOrFail($id->id);
        $funcionario->delete();
        return redirect()->back()->with('success','Funcionario deletado com sucesso');

    }
}
