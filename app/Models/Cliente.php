<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $guarded = [];

    use HasFactory;

    public function scopeIndex($query,$pesquisa){
        return $query->where([['user_id', [auth()->user()->id]],['nome', 'like', "%{$pesquisa}%"]]);
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function endereco(){
        return $this->hasOne('App\Models\ClienteEndereco');
    }
}
