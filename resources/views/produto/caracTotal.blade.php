@extends('layouts.main')

@section('title', 'Document')

@section('content')
@foreach ($produto->caracteristicas as $caracteristica)
<div class="modal fade" id="delete-address-{{$caracteristica->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Tem certeza que deseja excluir esta caracteristica?</h5>
        </div>
        <form action="/excluir-caracteristica-{{$caracteristica->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('DELETE')
            <div class="modal-body">
                <button type="button" class="second-btn modal-btn cancelar-modal" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="main-btn modal-btn">Excluir</button>
            </div>
        </form>
        </div>
    </div>
</div>
@endforeach
<div class="container-fluid vender">
    
        <div class="container" id="titulo">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="title-vender">
                        Preencha as informações do anúncio
                    </h1>
                </div>
            </div>
        </div>
        <div id="caracteristicas-area">
            <div class="container">
                <div class="row titulo-area">
                    <div class="col-md-12">
                        <div class="title-containers">
                            Pré-visualização
                        </div>
                    </div>
                    <div class="row texto-centralizado-meio">
                        <div class="col-md-2 padding-direita-dobro">
                            <p class="paragrafos-containers">Preço médio:</p>
                        </div>
                    </div>
                    <div class="row" id="opcoes">
                        <div class="col-md-2 padding-direita-dobro">
                            <input type="text" class="main-input" value="{{$produto->precoMedio}}" name="preco-minimo" id="preco-minimo-input" maxlength="30"  autocomplete="off" required disabled>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <p class="paragrafos-containers espaco-cima">Componentes atuais:</p>
                    </div>
                    @foreach ($produto->caracteristicas as $caracteristica)
                    <div class="sem">
                        <div class="opcoes">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                    <label class="input-group-text" for="opcao-">{{$caracteristica->caracteristica->nome}}</label>
                                    </div>
                                    <select id="form" class="custom-select" name="select">
                                        <option selected id="escolha" class="escolha" value="escolha">Escolha...</option>
                                        @foreach ($caracteristica->opcoes_real as $opcao)
                                            <option id="{{$opcao->pivot['id']}}" class="{{$opcao->pivot['id']}}" value="{{$opcao->pivot['id']}}"> 
                                                <p>{{$opcao->nome}}</p>
                                                <p> ---- R$: {{number_format($opcao->pivot['preco'],2)}}</p>
                                            </option>
                                        @endforeach
                                    </select>
                                        <button class="second-btn mais-opcao2"  value="menos" data-toggle="modal" data-target="#delete-address-{{$caracteristica->id}}"><i class="bi bi-dash"></i></button>
                                </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="row">
                        <div class="col-md-6">
                            <a href="/caracteristica-{{$produto->id}}">
                                <button class="main-btn mais-opcao" value="mais"><i class="bi bi-plus-lg"></i></button>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <div class="texto" >
                                
                                <p id="total">Total: <div class="inline2">R$</div></p>
                                <p id="valor">0
                                </p>
                                <sup class="centavos" id="valor-centavos">00</sup>
                                <div class="disponiveis2">Unidades disponíveis: <div id="quantidade-calculada"></div></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                    </div>
                    <div class="col-md-12">
                        <form action="/finish-product" method="post">
                            @csrf
                            <input type="text" name="id_produto" value="{{$produto->id}}" class="d-none">
                            <div class="modal-footer containers-botoes2">
                                    <button type="submit" class="main-btn modal-btn" value="avancar-2">Avançar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
<script>
    $("select").on('focus', function () {
        previous =  $(this).val();
        //console.log($('select[name="select"] option:selected').attr('class'));
    }).on("change", function() {
        valor = $(this).val();
        //vê se tem a classe 2
        //valor =$( "#"+valor1 ).hasClass( 2 );
        //alert(previous);
        //console.log(valor);
        //Aqui é onde consulta o controller sobre a compatibilidade
        precoTotal = 0;
        quantidadeMaxima =100;
        indice=0;
        semSelecionar=0;
        $( "option:selected" ).each(function(){
            id=this.id;
            sem=this.value;
            indice+=1;
            if(sem == 'escolha'){
                semSelecionar += 1;
            }
            @foreach ($produto->caracteristicas as $caracteristica)
                @foreach ($caracteristica->opcoes_real as $opcao)
                    pivot={{$opcao->pivot['id']}};
                    if(pivot==id){
                        preco={{$opcao->pivot['preco']}};
                        precoTotal+=preco;
                        quantidade={{$opcao->pivot['quantidade']}};
                        if(quantidade<quantidadeMaxima){
                            quantidadeMaxima=quantidade;
                        }
                    }
                @endforeach 
            @endforeach
        });
        decimal= precoTotal.toFixed(2);
        dividido=decimal.split('.');
        $('#valor').text(dividido[0]);
        $('#valor-centavos').text(dividido[1]);
        if(indice==semSelecionar){
            $('#quantidade-calculada').text('');
            $('.quantity').val('0').attr('max',0);
        }else{
            $('#quantidade-calculada').text(quantidadeMaxima);
            $('.quantity').val('1').attr('max',quantidadeMaxima);
        }
        


        $('.'+previous).not('#'+previous).removeClass(''+previous).each(function( index ) {
            var id=$(this).attr('id');
            var classe=$(this).attr('class');
            if(id === classe){
                $(this).prop('disabled', false);
                textoInput=$(this).text();
                $(this).empty();
                texto5=textoInput.replace(" (Incompatível)", "")
                $(this).append(texto5);
            }
        });
        





        $.ajax({
            url: '/selecionou',
            type: "get",
            data:{
                id:valor
            },
            dataType: 'json',
            success: function(response){
                if(response!=0){
                    for (var i = 0; i < response.length; i++) { 
                        var teste = response[i];
                        var id=$('#'+teste['carac_opcao_produto_carac_c_id']).attr('id');
                        var classe2=$('#'+teste['carac_opcao_produto_carac_c_id']).attr('class');
                        var classe = teste['carac_opcao_produto_carac_id'];
                        if(id===classe2){
                            $('#'+teste['carac_opcao_produto_carac_c_id']).append(' (Incompatível)');
                        }
                        $('#'+teste['carac_opcao_produto_carac_c_id']).prop('disabled', 'disabled');
                        $('#'+teste['carac_opcao_produto_carac_c_id']).addClass("" + classe);
                        //$('#'+teste['carac_opcao_produto_carac_c_id']).removeClass("" + classe);
                        //alert(teste['carac_opcao_produto_carac_c_id']);
                    }
                }
            }
        });
        

        //var valor = $(this).val();   // aqui vc pega cada valor selecionado com o this
    });
</script>
@endsection