<?php

namespace App\Http\Controllers;

use App\Models\Orcamento;
use App\Models\Servico;
use App\Models\ServicoImagem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServicoController extends Controller
{
    public Function index ($id){
        $servicos=Servico::with('imagens')->where('categoria',$id)->get();
        return view('servico.showAll',['servicos'=>$servicos,'categoria'=>$id]);
    }

    public function venderServico(Request $request){
        $user = auth()->user();
        $servico=Servico::where('user_id',$user->id)->where('categoria',$request->categoria)->get();
        if($servico->isEmpty()){
            return view('servico.venderServico',['categoria'=>$request->categoria]);
        }else{
            return redirect('/meus-servicos');
        }
    }

    public function storeStatus(Request $request){
        $user = auth()->user();
        $orcamento = Orcamento::findOrFail($request->id_orcamento);
        if($orcamento->servico->user->id==$user->id){
            $orcamento->update(['concluido'=>$request->concluido]);
            return redirect('/meus-servicos');
        }
    }

    public function showCategoria(){
        return view('servico.escolhaCategoria');
    }

    public function storeServico(Request $request){
        $user = auth()->user();
        $servico=  new Servico;
        $servico->user_id = $user->id;
        $servico->descricao = $request->descricao;
        $servico->descricao_simplificada = $request->descricao_simplificada;
        $servico->categoria = $request->categoria;
        $servico->save();

        $idServico=$servico->id;
        $files=$request->file('imagens');
        if($files){
            foreach($files as $file){
                $path = $file->store('produtos','s3');
                Storage::disk('s3')->setVisibility($path,'public');

                $imagem= ServicoImagem::create([
                    'filename'=>basename($path),
                    'imagem'=>Storage::disk('s3')->url($path),
                    'servico_id'=>$idServico
                ]);
            }
        }
        return redirect('/servico-'.$idServico);

    }

    public function storeOrcamento(Request $request){
        $servico=Servico::findOrFail($request->servico);
        if($servico->user->id!=auth()->user()->id){
            $orcamento = new Orcamento;
            $orcamento->servico_id = $request->servico;
            $orcamento->user_id = auth()->user()->id;
            $orcamento->link = $request->link;
            $orcamento->pref_contato = $request->contato;
            $orcamento->mensagem = $request->mensagem;
            $orcamento->concluido = 0;
            $orcamento->save();
            return redirect('/meus-servicos');
        }
    }

    public function showCategorias (){
        return view ('servico.escolherCategoriaVisualizacao');
    }

    public function show($id){
        $servico = Servico::findOrFail($id);
        return view('servico.show',['servico'=>$servico]);
    }

    public function meusServicos(){
        $user = auth()->user();
        $orcamentosPedidos =null;
        if( count($user->orcamentos)>0){
            $orcamentosPedidos=$user->orcamentos;
        }
        $orcamentosSolicitados = null;
        foreach ($user->servicos as $servico) {
            if($servico->categoria=="1"){
                $orcamentosSolicitados=$servico->orcamentos;
            }
        }
        $servicos=Servico::where([['categoria',1],['user_id',$user->id]])->get();
        return view('servico.view',['orcamentosPedidos'=>$orcamentosPedidos, 'orcamentosSolicitados'=>$orcamentosSolicitados,'servicos'=>$servicos]);
    }
}
