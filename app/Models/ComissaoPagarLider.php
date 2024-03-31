<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComissaoPagarLider extends Model
{
    use HasFactory;
    protected $fillable=[
        'id_pagamentopor_contratos', 
        'id_contrato',
        'id_lider',
        'valor_comissao_atual',
        'status'
    ];
    public function lider(){
        return $this->belongsTo(User::class,'id_lider');
    }
}
