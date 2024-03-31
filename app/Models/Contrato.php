<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'id_produto',
        'id_unidade',
        'id_vendedor',
        'id_cliente',
        'valor_contrato',
        'inicio_contrato',
        'primeiro_pagamento',
        'quant_meses',
        'forma_pagamento',
        'parcelas',
        'id_regra',  
        'inicio_contrato',
        'primeiro_pagamento',
    ];
    public function produto(){
        return $this->belongsTo(Produto::class,'id_produto');
    }
    public function unidade(){
        return $this->belongsTo(Unidade::class,'id_unidade');
    }
    public function vendedor(){
        return $this->belongsTo(User::class,'id_vendedor');
    }
    public function cliente(){
        return $this->belongsTo(Clientes::class,'id_cliente');
    }
    public function regra(){
        return $this->belongsTo(RegraComissao::class,'id_regra');
    }
    
    

}
