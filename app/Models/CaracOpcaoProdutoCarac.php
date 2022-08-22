<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaracOpcaoProdutoCarac extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function caracteristica(){
        return $this->belongsTo('App\Models\ProdutoCarac');
    }


    public function opcoes(){
        return $this->belongsTo('App\Models\CaracOpcao');
    }
}
