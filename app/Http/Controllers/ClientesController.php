<?php

namespace App\Http\Controllers;
use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Http\Requests\ClienteRequest;
use App\Models\ClienteEndereco;
use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
{
    public function index(Request $request){
        $clientes = Cliente::index($request->pesquisa)->paginate(2);
        return view('clientes.listar', ['clientes'=>$clientes]);
    }

    public function novo(){
        return view('clientes.visualizar');
    }

    public function adicionar (ClienteRequest $request){
        $dados = $request->all();
        DB::transaction(function() use ($dados) {
            $cliente = Cliente::create([
                'user_id' => auth()->user()->id,
                'nome' => $dados['nome'],
                'cpf' => $dados['cpf'],
                'categoria' => $dados['categoria'],
                'telefone' => $dados['telefone']
            ]);

            ClienteEndereco::create([
                'cliente_id'=>$cliente->id,
                'cep'=>$dados['cep'],
                'cidade'=>$dados['cidade'],
                'estado'=>$dados['estado'],
                'endereco'=>$dados['endereco'],
                'numero'=>$dados['numero'],
                'complemento'=>$dados['complemento'],
                'bairro'=>$dados['bairro']
            ]);
        });
        return redirect('/clientes')->with('info', 'Cliente cadastrado com sucesso!');
    }


    public function editar($id){
        $cliente = Cliente::findOrFail($id);
        $this->authorize('dono',$cliente);
        return view('clientes.visualizar', ['cliente'=>$cliente]);
    }

    public function alterar ($id, ClienteRequest $request){
        $dados = $request->all();
        DB::transaction(function() use ($dados, $id) {
            Cliente::findOrFail($id)->update([
                'nome' => $dados['nome'],
                'cpf' => $dados['cpf'],
                'categoria' => $dados['categoria'],
                'telefone' => $dados['telefone']
            ]);

            ClienteEndereco::where('cliente_id', $id)->firstOrFail()->update([
                'cep' => $dados['cep'],
                'cidade' => $dados['cidade'],
                'estado' => $dados['estado'],
                'endereco' => $dados['endereco'],
                'numero' => $dados['numero'],
                'complemento' => $dados['complemento'],
                'bairro' => $dados['bairro']
            ]);
        });

        return redirect('/clientes')->with('info', 'Cliente alterado com sucesso!');
    }

    public function deletar ($id){
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();
        return redirect('/clientes')->with('info', 'Cliente deletado com sucesso!');
    }
}
