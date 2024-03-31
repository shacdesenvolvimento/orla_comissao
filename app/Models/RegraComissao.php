<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegraComissao extends Model
{
    use HasFactory;

    protected $fillable=[
        'id', 
        'nome',
        'quant_meses',
        'valor_minimo'
    ];
}
