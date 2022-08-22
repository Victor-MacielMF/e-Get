@extends('layouts.main')

@section('title', 'Document')

@section('content')


<div class="container-fluid">
    
    <div id="navigation-area">
        <div class="container sub-navigation">
            <a href="/">Home</a> > 
            <a href="/produtos">Produtos</a> > 
            <a href="produtos-{{$produto->categorias[0]->id}}">{{$produto->categorias[0]->nome}}</a> >
            <a href="">{{$produto->nome}}</a>
        </div>
    </div>
    {{-- Produto --}}

    <div id="produto-view-area">
        <form action="">
            <div class="container sem-padding">
                <div class="row">
                    <div class="col-md-5 azul">
                        <div id="carousel" class="carousel slide" data-ride="carousel" data-pause="hover" data-interval="false">
                            <div class="carousel-inner">
                                {{$indice=0}}
                                @foreach ($produto->imagens as $imagem)
                                    @if ($indice==0)
                                        <div class="carousel-item active" style="background-image: url({{$imagem->imagem}});">
                                        </div>
                                    @else
                                        <div class="carousel-item" style="background-image: url({{$imagem->imagem}});">
                                        </div>
                                    @endif
                                    {{$indice+=1}}
                                @endforeach
                            </div>
                            <ol class="carousel-indicators">
                                {{$indice=0}}
                                @foreach ($produto->imagens as $imagem)
                                    @if ($indice==0)
                                        <li data-target="#carousel" data-slide-to="{{$indice}}" class="indicator active"></li>
                                    @else
                                        <li data-target="#carousel" data-slide-to="{{$indice}}" class="indicator"></li>
                                    @endif
                                    {{$indice+=1}}
                                @endforeach
                            </ol>
                        </div>






                    </div>
                    <div class="col-md-7 vermelho">
                        <div class="row row-produto">
                            <div class="sem">
                            <h1 class="titulo-produto">{{$produto->nome}}</h1>
                            <p class="descricao">{{$produto->descricao}} 
                                
                            </p>

                            </div>
                        
                            @if (empty($caracteristicas[0]))
                                <div class="ocupar-espaco">
                                </div>
                            @endif

                                <form>
                                    @csrf
                                    @foreach ($caracteristicas as $caracteristica)
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
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </form>

                        <div class="col-md-6 sem">
                            <div>
                                <label class="quantidade">Quantidade:</label>
                                <div class="number-input">
                                    <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="sem-form"><i class="bi bi-dash"></i></button>
                                    <input class="quantity" min="0" name="quantity" value="0" type="number" max="0" required>
                                    <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus sem-form"><i class="bi bi-plus"></i></button>
                                </div>
                            </div>
                            <div class="disponiveis">Unidades disponíveis: <div id="quantidade-calculada"></div></div>

                            <div class="consultar-cep">
                                <label class="consultar">Consultar frete e prazo de entrega</label>
                                <input type="text" class="form-control main-input input-cep" onkeypress="$(this).mask('00.000-000')" minlength="10">
                                <button class="main-btn cep sem-form">OK</button>
                            </div>
                        </div>
                        <div class="col-md-6 sem">
                                <div class="texto" >
                                    <p id="total">Total: <div class="inline2">R$</div></p>
                                    <p id="valor">0
                                    </p>
                                    <sup class="centavos" id="valor-centavos">00</sup>
                                    <br>
                                    <p class="em">em</p>
                                    <p class="juros"> 12x R$ XXX<sup>aa</sup> sem juros</p>
                                </div>
                            <button class="comprar">
                                <i class="bi bi-cart-fill"></i> Carrinho
                            </button>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <div id="vendedor-area">
        <div class="container sem-padding">
            <div class="row">

                <div class="col-md-5 avaliacao">
                    <div id="area-notas">
                        <h2>Avaliações dos compradores</h2>
                        <div class="notas">
                            <h1>3.5</h1>
                            <div class="campo-estrelas-avaliacoes">
                                <div class="estrelas">
                                    <i class="bi bi-star-fill align-top"></i>
                                    <i class="bi bi-star-fill align-top"></i>
                                    <i class="bi bi-star-fill align-top"></i>
                                    <i class="bi bi-star-half align-top"></i>
                                    <i class="bi bi-star align-top"></i>
                                </div>
                                <p id="total-avaliacoes">(172 Avaliações)</p>
                            </div>
                        </div>
                        <div id="data-area">
                              <div class="row">
                                <div class="col-md-1 col-xs-2 circle-box">
                                </div>
                                <div class="col-md-2 col-xs-4 circle-box">
                                    <p>1 estrela</p>
                                  <div id="circleA"></div>
                                </div>
                                <div class="col-md-2 col-xs-4 circle-box">
                                    <p>2 estrelas</p>
                                  <div id="circleB"></div>
                                </div>
                                <div class="col-md-2 col-xs-4 circle-box">
                                    <p>3 estrelas</p>
                                  <div id="circleC"></div>
                                </div>  
                                <div class="col-md-2 col-xs-4 circle-box">
                                    <p>4 estrelas</p>
                                  <div id="circleD"></div>
                                </div>
                                <div class="col-md-2 col-xs-4 circle-box">
                                    <p>5 estrelas</p>
                                    <div id="circleE"></div>
                                </div>
                                <div class="col-md-1 col-xs-2 circle-box">
                                </div>
                              </div>
                        </div>
                </div>
            </div>
            
            <div class="col-md-7 mais-produtos">
                <div class="row">
                    
                    <div class="col-12">
                        <h3 class="main-title">OUTROS PROdutos deste VEndedor</h3>
                      </div>
                      <div class="col-md-3">
                        <a href="" class="none">
                            <div class="card">
                                <h5 class="card-title">Robô Otto</h5>
                                <div class="foto-produto" style="background-image: url(/img/produto/3.png);"></div>
                            <div class="card-body">
                                <p class="card-text">R$ 500<sup>50</sup> </p>
                            </div>
                            </div>
                        </a>
                      </div>
                      <div class="col-md-3">
                        <a href="" class="none">
                            <div class="card">
                                <h5 class="card-title">Jhon Doe</h5>
                                <div class="foto-produto" style="background-image: url(/img/produto/7.jpg);"></div>
                            <div class="card-body">
                                <p class="card-text">R$ 500<sup>50</sup> </p>
                            </div>
                            </div>
                        </a>
                      </div>
                      <div class="col-md-3">
                        <a href="" class="none">
                            <div class="card">
                                <h5 class="card-title">Jhon Doe</h5>
                                <div class="foto-produto" style="background-image: url(https://storage.googleapis.com/ygoprodeck.com/pics_small/6983839.jpg);"></div>
                            <div class="card-body">
                                <p class="card-text">R$ 500<sup>50</sup> </p>
                            </div>
                            </div>
                        </a>
                      </div>
                      <div class="col-md-3">
                        <a href="" class="none">
                            <div class="card">
                                <h5 class="card-title">Jhon Doe</h5>
                                <div class="foto-produto" style="background-image: url(/img/produto/7.jpg);"></div>
                            <div class="card-body">
                                <p class="card-text">R$ 500<sup>50</sup> </p>
                            </div>
                            </div>
                        </a>
                      </div>
                        <div class="col-md-12">
                            <a href="" class="mais-anuncios align-bottom">Ver mais anúncios deste vendedor</a>
                        </div>
                </div>
            </div>
        </div>
    </div>

    <div id="comentarios">
        <div class="container">
            <div class="row">
                @auth
                    @if ($produto->user_id != auth()->user()->id)
                        <form action="/comentar" method="POST">
                            @csrf
                            <div class="row">
                                <input type="text" value="{{$produto->id}}" name="produto" class="d-none">
                                <div class="col-md-12">
                                    <h4>Pergunte ao vendedor</h4>
                                </div>
                                <div class="col-md-10 coluna">
                                    <input type="text" name="pergunta" class="form-control main-input pergunta" autocomplete="off">
                                </div>
                                <div class="col-md-2 coluna">
                                    <button class="main-btn pergunte">Pergunte</button>
                                </div>
                            </div>
                        </form>
                        
                        <div class="area-pergunta">
                        </div>
                    @else
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="perguntas-clientes">Perguntas dos clientes</h4>
                            </div>
                        </div>

                    @endif
                @endauth

                @guest
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="perguntas-clientes">Pergunte ao vendedor</h4>
                            </div>
                        </div>
                @endguest


                @if(count($produto->comentarios) < 1)
                    <div class="row">
                        <div class="col-md-12 sem-perguntas">
                            @auth
                                @if ($produto->user_id != auth()->user()->id)
                                    <h4>Seja o primeiro a comentar</h4>
                                @else
                                    <h4>Este produto ainda não possui perguntas</h4>
                                @endif
                            @endauth
                            @guest
                                <h4>Cadastre-se e seja o primeiro a comentar</h4>
                            @endguest
                        </div>
                    </div>
                @endif


                @foreach ($produto->comentarios as $comentario)
                
                    <div class="col-md-12 parte-pergunta">
                        <form action="/pergunta/excluir/{{$comentario->id}}" method="POST">
                            @csrf
                            @method("DELETE")
                            <div class="row testezinho">
                                <p class="perguntas">{{$comentario->comentario}}
                                    @auth
                                        @if (auth()->user()->id == $comentario->user_id)
                                            <button class="excluir-resposta">Excluir</button>
                                        @endif
                                    @endauth
                                </p>
                            </div>
                        </form>
                            @foreach ($comentario->respostas as $resposta)
                                <form action="/resposta/excluir/{{$resposta->id}}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <div class="row testezinho testezinho-resposta">
                                        <p class="respostas">{{$resposta->comentario}}
                                            @auth
                                                @if (auth()->user()->id == $resposta->user_id)
                                                    <button class="excluir-resposta">Excluir</button>
                                                @endif
                                            @endauth
                                        </p>
                                    </div>
                                </form>
                            @endforeach
                            
                    </div>
                    @auth

                    @if ($produto->user_id == auth()->user()->id)
                        <form action="/responder" method="POST">
                            @csrf
                            <input type="text" class="d-none" value="{{$comentario->id}}" name="comentario">
                            <div class="row">
                                <input type="text" name="pergunta" class="form-control main-input resposta" autocomplete="off">
                                <div class="arrumar-padding justify-contend-end">
                                    <button class="responder">Responder</button>
                                </div>
                            </div>
                        </form>
                    @endif

                    @else
                    <div class="heigh1"></div>
                    @endauth
                @endforeach
            </div>
        </div>
    </div>
    
</div>

<script>

    $( ".comprar" ).click(function() {
        if(!(($('.quantity').val()!=0)&&($('.quantity').val()!=''))){
            event.preventDefault();
            alert("Informe a quantidade");
        }
    });

    $( ".sem-form" ).click(function() {
        event.preventDefault();
    });

    $(function(){
        var previous;
        numero=2;

        @if ($produto->preco)
            quantidadeProduto={{$produto->quantidade}};
            produtoPreco= {{$produto->preco}};
            prodPreco=produtoPreco.toFixed(2);
            dividido=prodPreco.split('.');
            $('#valor').text(dividido[0]);
            $('#valor-centavos').text(dividido[1]);
            $('#quantidade-calculada').text(quantidadeProduto);
            $('.quantity').val('1').attr('max',quantidadeProduto);
        @endif
        

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
                @foreach ($caracteristicas as $caracteristica)
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








        // Progress bar
        let containerA=document.getElementById("circleA");
    
        let circleA= new ProgressBar.Circle(containerA,{
            color:'#E5CD14',
            // largura do circulo
            strokeWidth:12,
            duration: 1400,
            from:{ color:'#202226'},
            to:{color:'#E5CD14'},
    
            step: function(state, circle){
                circle.path.setAttribute('stroke',state.color);
    
                let value = Math.round(circle.value()*60);
    
                circle.setText(value);
            }
        });
    
        let containerB=document.getElementById("circleB");
    
        let circleB= new ProgressBar.Circle(containerB,{
            color:'#E5CD14',
            // largura do circulo
            strokeWidth:12,
            duration: 1600,
            from:{ color:'#202226'},
            to:{color:'#E5CD14'},
    
            step: function(state, circle){
                circle.path.setAttribute('stroke',state.color);
    
                let value = Math.round(circle.value()*245);
    
                circle.setText(value);
            }
        });
    
        let containerC=document.getElementById("circleC");
    
        let circleC= new ProgressBar.Circle(containerC,{
            color:'#E5CD14',
            // largura do circulo
            strokeWidth:12,
            duration: 1800,
            from:{ color:'#202226'},
            to:{color:'#E5CD14'},
    
            step: function(state, circle){
                circle.path.setAttribute('stroke',state.color);
    
                let value = Math.round(circle.value()*32);
    
                circle.setText(value);
            }
        });
    
        let containerD=document.getElementById("circleD");
    
        let circleD= new ProgressBar.Circle(containerD,{
            color:'#E5CD14',
            // largura do circulo
            strokeWidth:12,
            duration: 2000,
            from:{ color:'#202226'},
            to:{color:'#E5CD14'},
    
            step: function(state, circle){
                circle.path.setAttribute('stroke',state.color);
    
                let value = Math.round(circle.value()*52);
    
                circle.setText(value);
            }
        });
    
        let containerE=document.getElementById("circleE");
    
        let circleE= new ProgressBar.Circle(containerE,{
            color:'#E5CD14',
            // largura do circulo
            strokeWidth:12,
            duration: 2000,
            from:{ color:'#202226'},
            to:{color:'#E5CD14'},
    
            step: function(state, circle){
                circle.path.setAttribute('stroke',state.color);
    
                let value = Math.round(circle.value()*24);
    
                circle.setText(value);
            }
        });
    
    
        // iniciando o loader quando o usuário chega no elemento
        let dataAreaOffset = $('#data-area').offset();
        let stop=0;
    
        $(window).scroll(function(e){
            let scroll = $(window).scrollTop();
    
            if(scroll>(dataAreaOffset.top - 700) && stop == 0){
                circleA.animate(1.0)
                circleB.animate(1.0)
                circleC.animate(1.0)
                circleD.animate(1.0)
                circleE.animate(1.0)
    
                stop = 1;
            }
        });
    
    
    });
</script>
@endsection