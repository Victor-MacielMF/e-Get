<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function produto(){
        return $this->belongsTo('App\Models\Produto');
    }

    public function respostas(){
        return $this->hasMany('App\Models\ComentarioResposta');
    }
}
