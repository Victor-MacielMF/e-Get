<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compatibilidade extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function caracteristica(){
        return $this->belongsTo('App\Models\ProdutoCarac');
    }
    public function opcao(){
        return $this->belongsTo('App\Models\ProdutoCarac');
    }
}
