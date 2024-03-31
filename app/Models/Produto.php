<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    protected $fillable=[
        'id', 
        'nome',
        'id_regra'
    ];
    public function regra(){
        return $this->belongsTo(RegraComissao::class,'id_regra');
    }
  
}
