<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function imagens() {
        return $this->hasMany('App\Models\ProdutoImagem');
    }

    public function categorias() {
        return $this->belongsToMany('App\Models\Categoria');
    }

    public function caracteristicas(){
        return $this->hasMany('App\Models\ProdutoCarac');
    }

    public function comentarios(){
        return $this->hasMany('App\Models\Comentario');
    }
}
