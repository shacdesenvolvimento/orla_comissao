<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class regra_por_contrato extends Model
{
    use HasFactory;
    protected $fillable=[
        'id', 
        'id_contrato',
        'id_regra',
        'id_vendedor',
        'permissao_comissao'
    ];
}
