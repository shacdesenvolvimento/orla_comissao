<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComissaoPagarVendedor extends Model
{
    use HasFactory;
    protected $fillable=[
        'id_pagamentopor_contratos', 
        'id_contrato',
        'id_vendedor',
        'id_lider',
        'valor_comissao_atual',
        'status'
    ];
    public function vendedor(){
        return $this->belongsTo(User::class,'id_vendedor');
    }
        
}
