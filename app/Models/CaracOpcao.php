<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaracOpcao extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function caracteristica(){
        return $this->belongsTo('App\Models\Caracteristica');
    }

    
    public function produtos(){
        return $this->hasMany('App\Models\CaracOpcaoProdutoCarac');
    }

    public function caracteristica_produto(){
        return $this->belongsToMany('App\Models\ProdutoCarac')->withPivot('preco', 'quantidade','id');
    }
}
