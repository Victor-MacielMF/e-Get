<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
    public function imagens(){
        return $this->hasMany('App\Models\ServicoImagem');
    }
    public function orcamentos(){
        return $this->hasMany('App\Models\Orcamento');
    }
}
