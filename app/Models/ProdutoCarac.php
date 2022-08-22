<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutoCarac extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function produto(){
        return $this->belongsTo('App\Models\Produto');
    }
    public function opcoes(){
        return $this->hasMany('App\Models\CaracOpcaoProdutoCarac');
    }

    
    public function caracteristica(){
        return $this->belongsTo('App\Models\Caracteristica');
    }

    public function opcoes_real(){
        return $this->belongsToMany('App\Models\CaracOpcao')->withPivot('preco', 'quantidade','id');
    }

    
    public function compatibilidade(){
        return $this->hasMany('App\Models\Compatibilidade');
    }
}
