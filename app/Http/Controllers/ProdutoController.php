<?php

namespace App\Http\Controllers;

use App\Models\CaracOpcao;
use App\Models\Caracteristica;
use App\Models\Categoria;
use App\Models\Comentario;
use App\Models\ComentarioResposta;
use App\Models\Compatibilidade;
use App\Models\Produto;
use App\Models\ProdutoCarac;
use App\Models\ProdutoImagem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ProdutoController extends Controller
{

    public Function index ($id){
        $categorias=Categoria::findOrFail($id);
        return view('produto.showAll',['categorias'=>$categorias]);
    }

    public function showCategorias (){
        return view ('produto.escolherCategoriaVisualizacao');
    }

    public function show ($id){
        $produto = Produto::findOrFail($id);
        $caracteristicas = $produto->caracteristicas;
        return view('produto.show',['produto'=>$produto,'caracteristicas'=>$caracteristicas]);

    }

    public function selecionou (Request $request){
        $data = $request->all();
        //$compatibilidades = Compatibilidade::where(['carac_opcao_produto_carac_id'=>$data['id']])->get();


        $compatibilidade = DB::table('compatibilidades')->where('carac_opcao_produto_carac_id','=',$data['id'])->get();


            echo json_encode($compatibilidade);
            return;
        
        //
        //echo json_encode($compatibilidades);
    }

    public function selecionado (Request $request){
        $data = $request->all();
        $preco=DB::table('carac_opcao_produto_carac')->where('id','=',$data['id'])->get();
        echo json_encode($preco);
        return;
    }

    public function comentar (Request $request){
        $user = auth()->user();
        $comentario = new Comentario;
        $comentario->comentario = $request->pergunta;
        $comentario->produto_id = $request->produto;
        $comentario->user_id = $user->id;

        $comentario->save();
        return Redirect::back();
    }

    public function responder (Request $request){
        $user = auth()->user();
        $comentario = new ComentarioResposta;
        $comentario->comentario = $request->pergunta;
        $comentario->comentario_id = $request->comentario;
        $comentario->user_id=$user->id;

        $comentario->save();
        return Redirect::back();
    }

    public function excluirPergunta ($id){
        Comentario::findOrFail($id)->delete();
        return Redirect::back();
    }

    public function excluirResposta ($id){
        ComentarioResposta::findOrFail($id)->delete();
        return Redirect::back();
    }

    public function choose(){
        return view('produto.choose');
    }

    public function venderProduto(){
        return view('produto.venderProduto');
    }

    public function caracteristicaProduto($id){
        $user = auth()->user();
        $produto=Produto::findOrFail($id);
        if(($produto->user_id!=$user->id)||($produto->pendente!=1)){
            return redirect('/home');
        }else{
            return view('produto.caracProduto',['produto'=>$produto]);
        }
    }
    public function excluirCaracteristica($id){
        $user = auth()->user();
        $caracteristica=  ProdutoCarac::findOrFail($id);
        $idProduto=$caracteristica->produto->id;
        if($user->id==$caracteristica->produto->user_id){
            $maior=null;
            $menor=null;
            foreach ($caracteristica->opcoes_real as $opcao) {
                if(($maior==null)||($maior<$opcao->pivot->preco)){
                    $maior=$opcao->pivot->preco;
                }
                if(($menor==null)||($menor>$opcao->pivot->preco)){
                    $menor=$opcao->pivot->preco;
                }
            }
            $produto= Produto::findOrFail($caracteristica->produto_id);
            $produto->precoMaximo-=$maior;
            $produto->precoMinimo-=$menor;
            $produto->precoMedio=($produto->precoMaximo+$produto->precoMinimo)/2;
            $produto->save();
            $caracteristica->delete();
            return Redirect::route('/caracteristicas', [$idProduto]);
        }
    }

    public function storeProduto(Request $request){
        if($request->componentes == "S"){
            //tem componentes
            $user = auth()->user();
            $produto=  new Produto;
            $produto->user_id = $user->id;
            $produto->nome =$request->titulo;
            $produto->pendente=1;
            $produto->save();
            $produto->categorias()->attach($request->categoria);
    
            $idProduto=$produto->id;
    
            
            $input=$request->all();
            $images=array();
            $files=$request->file('imagens');
            if($files){
                foreach($files as $file){
                    $path = $file->store('produtos','s3');
                    Storage::disk('s3')->setVisibility($path,'public');

                    $imagem= ProdutoImagem::create([
                        'filename'=>basename($path),
                        'imagem'=>Storage::disk('s3')->url($path),
                        'produto_id'=>$idProduto
                    ]);
                    //return Storage::disk('s3')->response('produtos/'.$imagem->filename);
                }
            }
    
            return view('produto.caracProduto',['produto'=>$produto]);
            //return redirect('/produto/caracteristicas/'.$idProduto)->with( ['informacao' => $produto] );;


        }else{
            //Não tem componentes
            $user = auth()->user();
            $produto=  new Produto;
            $produto->user_id = $user->id;
            $produto->nome =$request->titulo;
            $produto->descricao = $request->descricao;
            $produto->descricao_simplificada = $request->descricao_simplificada;
            
            $produto->quantidade=$request->quantidade;
            $produto->pendente=0;

            $formatando=preg_replace("/[^0-9,]/", "", $request->preco);
            $formatado=str_replace(',', '.', $formatando);

            $produto->preco=$formatado;
    
            $produto->save();
            $produto->categorias()->attach($request->categoria);
    
            $idProduto=$produto->id;
            $files=$request->file('imagens');
            if($files){
                foreach($files as $file){
                    $path = $file->store('produtos','s3');
                    Storage::disk('s3')->setVisibility($path,'public');

                    $imagem= ProdutoImagem::create([
                        'filename'=>basename($path),
                        'imagem'=>Storage::disk('s3')->url($path),
                        'produto_id'=>$idProduto
                    ]);
                }
            }
            return redirect('/produto-'.$idProduto);

        }

    }

    public function showCaracteristicas($id){
        $user = auth()->user();
        $produto = Produto::findOrFail($id);
        if(($produto->user_id==$user->id)&&($produto->pendente==1)){
            return view('produto.caracTotal',['produto'=>$produto]);
        }else{
            return redirect('/home');
        }
       //return view('produto.show',['produto'=>$produto,'caracteristicas'=>$caracteristicas]);
    }

    public function storeCaracteristica(Request $request){
        //é isso, a cada rodada eu vou perguntar isso por meio de um indice com o nome do array
        //dd($request->has('compatibilidade'));
        $user = auth()->user();
        $produto=Produto::findOrFail($request->produto_id);
        if($produto->user_id==$user->id){
            $caracteristica= new Caracteristica;
            $caracProduto= new ProdutoCarac;
            $caracteristica->nome=$request->nome_caracteristica;
            $caracteristica->save();
            $caracProduto->produto_id=$produto->id;
            $caracProduto->caracteristica_id=$caracteristica->id;
            $caracProduto->save();
            $count = count($request->opcao);

            $compPrimaria = array();
            $compSecundaria = array();

            $count2=0;
            if($request->has('compatibilidade')){
                $count2 = count($request->compatibilidade);
                for ($i=0; $i < $count2; $i++) { 
                    $variavel=$request->compatibilidade[$i];
                    $dividido=explode(".", $variavel);
                    array_push($compPrimaria,$dividido[0]);
                    array_push($compSecundaria,$dividido[1]);
                }
            }
            $maior=null;
            $menor=null;
            for ($i=0; $i < $count; $i++) { 
                $caracOpcao= new CaracOpcao;
                $caracOpcao->caracteristica_id=$caracteristica->id;
                $caracOpcao->nome=$request->opcao[$i];
                $caracOpcao->save();
                //teste para ver se desse modo eu consigo cadastrar a opção pelo attach. Antes disso eu n fiz nada para que isso aconteça
                $formatando=preg_replace("/[^0-9,]/", "", $request->preco[$i]);
                $formatado=str_replace(',', '.', $formatando);
                if(($maior==null)||($maior<$formatado)){
                    $maior=$formatado;
                }
                if(($menor==null)||($menor>$formatado)){
                    $menor=$formatado;
                }
                

                $caracProduto->opcoes_real()->attach($caracOpcao->id,[
                    'preco' => $formatado,
                    'quantidade' => $request->qtd[$i]
                ]);
                for ($a=0; $a < $count2; $a++) {
                    if($compPrimaria[$a]==$i){
                        foreach($caracOpcao->caracteristica_produto as $opcao){
                            $compatibilidade= new Compatibilidade;
                            $compatibilidadeReversa= new Compatibilidade;

                            $compatibilidade->carac_opcao_produto_carac_id =  $opcao->pivot->id;
                            $compatibilidade->carac_opcao_produto_carac_c_id = $compSecundaria[$a];
                            $compatibilidade->produto_id = $produto->id;

                            $compatibilidadeReversa->carac_opcao_produto_carac_id =  $compSecundaria[$a];
                            $compatibilidadeReversa->carac_opcao_produto_carac_c_id = $opcao->pivot->id;
                            $compatibilidadeReversa->produto_id = $produto->id;

                            $compatibilidade->save();
                            $compatibilidadeReversa->save();
                        }
                    }
                }
                

            }
            $produto->precoMinimo+=$menor;
            $produto->precoMaximo+=$maior;
            $media=($produto->precoMaximo+$produto->precoMinimo)/2;
            $produto->precoMedio=$media;
            $produto->save();
            return view('produto.caracTotal',['produto'=>$produto]);
        }
    }


    public function showCategoria(){
        return view('categoria.categoria');
    }
    
    public function storeCategoria(Request $request){
        $categoria = new Categoria;
        $categoria->nome = $request->categoria;
        $categoria->save();
        return Redirect::back();
    }

    public function cancelarCaracteristica($id){
        $produto= Produto::findOrFail($id);
        $user = auth()->user();
        if(($produto->user_id==$user->id)&&($produto->pendente==1)){
            $caracteristicas=$produto->caracteristicas;
            if($caracteristicas->isEmpty()){
                return view('produto.continuarProduto',['produto'=>$produto]);
            }else{
                return Redirect::route('/caracteristicas', [$id]);
            }
        }
        //return Redirect::route('/caracteristicas', [$id]);
    }
    public function finalizarProduto1(Request $request){
        $produto= Produto::findOrFail($request->id_produto);
        $user = auth()->user();
        if(($produto->user_id==$user->id)&&($produto->pendente==1)){
            if(($request->has('preco'))&&($request->has('quantidade'))){
                $formatando=preg_replace("/[^0-9,]/", "", $request->preco);
                $formatado=str_replace(',', '.', $formatando);
                $produto->preco=$formatado;
                $produto->descricao_simplificada=$request->descricao_simplificada;
                $produto->descricao=$request->descricao;
                $produto->quantidade=$request->quantidade;
                $produto->pendente=0;
                $produto->save();
                //return redirect('/home');
                return redirect('/produto-'.$produto->id);
            }else{
                $produto->descricao_simplificada=$request->descricao_simplificada;
                $produto->descricao=$request->descricao;
                $produto->pendente=0;
                $produto->save();
                //return redirect('/home');
                return redirect('/produto-'.$produto->id);
            }
        }
    }

    public function finalizarProduto2(Request $request){

        $produto= Produto::findOrFail($request->id_produto);
        $user = auth()->user();
        if(($produto->user_id==$user->id)&&($produto->pendente==1)){
            $caracteristicas=$produto->caracteristicas;
            if($caracteristicas->isEmpty()){
                return view('produto.continuarProduto',['produto'=>$produto]);
            }else{
                return view('produto.continuarProduto2',['produto'=>$produto]);
            }
        }
    }
}
