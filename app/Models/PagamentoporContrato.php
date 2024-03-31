<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagamentoporContrato extends Model
{
    use HasFactory;
    protected $fillable=[
        'id', 
        'id_contrato',
        'id_vendedor',
        'id_lider',
        'valor_parcela',
        'total_atual',
        'quant_parcela_atual',
        'created_at',
        'updated_at'
    ];
}
