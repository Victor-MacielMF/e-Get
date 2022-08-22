<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'cpf' ,
        'rg' ,
        'sexo' ,
        'nascimento',
        'telefone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function enderecos() {
        return $this->hasMany('App\Models\Endereco');
    }

    public function clientes() {
        return $this->hasMany('App\Models\Cliente');
    }

    public function produtos(){
        return $this->hasMany('App\Models\Produto');
    }
    public function servicos(){
        return $this->hasMany('App\Models\Servico');
    }
    public function orcamentos(){
        return $this->hasMany('App\Models\Orcamento');
    }

    public function comentarios(){
        return $this->hasMany('App\Models\Comentario');
    }

}
