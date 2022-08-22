<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Endereco;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

class Alter extends Controller
{

    public function index()
    {
        $user = auth()->user();
        $enderecos = $user->enderecos;
        return view('usuario.view', ['user'=>$user, 'enderecos' => $enderecos]);
    }

    public function destroy($id){
        Endereco::findOrFail($id)->delete();
        return redirect('/meus-dados')->with('info','Endereço excluído com sucesso!');
    }

    public function updateAddress(Request $request){
        $data = $request->all();
        Endereco::findOrFail($request->id)->update($data);
        return redirect('/meus-dados')->with('info', 'Endereço editado com sucesso!');

    }

    public function updateUser(Request $request){
        $date = str_replace ( '/' , '-' , $request->nascimento);
        $nascimento=date("Y/m/d", strtotime($date));

        $data = $request->all();
        $data['nascimento']=$nascimento;
        User::findOrFail($request->id)->update($data);
        return redirect('/meus-dados')->with('info', 'Dados pessoais editados com sucesso!');
    }


    public function storeAddress(Request $request){
        $endereco = new Endereco;
        $user = auth()->user();
        $endereco->cep= $request->cep;
        $endereco->cidade= $request->cidade;
        $endereco->estado= $request->estado;
        $endereco->endereco= $request->endereco;
        $endereco->numero= $request->numero;
        $endereco->complemento= $request->complemento;
        $endereco->bairro= $request->bairro;
        $endereco->referencia= $request->referencia;
        $endereco->user_id=$user->id;
        $endereco->save();
        return redirect('/meus-dados')->with('info', 'Endereco criado com sucesso!');
    }
}
