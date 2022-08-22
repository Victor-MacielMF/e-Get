<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caracteristica extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function opcoes(){
        return $this->hasMany('App\Models\CaracOpcao');
    }

    public function produtos(){
        return $this->hasMany('App\Models\ProdutoCarac');
    }
}
