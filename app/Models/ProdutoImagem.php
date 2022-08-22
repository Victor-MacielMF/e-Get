<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutoImagem extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function produto(){
        return $this->belongsTo('App\Models\Produto');
    }
}
