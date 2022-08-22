@extends('layouts.main')

@section('title', 'Document')

@section('content')



<div class="container-fluid">
    <div id="produtos-area">
        <div class="container sem-padding">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="title-vender">
                        {{$categorias->nome}}
                    </h1>
                </div>
                <p class="d-none">{{$quantidadeProduto=0}}</p>
                @foreach ($categorias->produtos as $produto)
                    @if ($produto->pendente=="0")
                        <div class="col-md-2 sem-padding">
                            <a href="/produto-{{$produto->id}}" class="none">
                                <div class="card produtos-all">
                                    <h5 class="product-title">{{$produto->nome}}</h5>

                                    <p class="d-none">{{$indice=0}}</p>
                                    @foreach ($produto->imagens as $imagem)
                                        @if($indice==0)
                                            <div class="product-image" style="background-image: url({{$imagem->imagem}});"></div>
                                        @endif
                                        <p class="d-none">{{$indice+=1}}</p>
                                    @endforeach

                                    <div class="card-body">

                                        @if ($produto->preco)
                                            <div class="todos-inline">
                                                R$
                                                <p id="valor-{{$produto->id}}" class="sem-margin">500</p>
                                                <sup class="centavos-produto" id="valor-centavos-{{$produto->id}}">40</sup>
                                            </div>
                                            <script>
                                                    var nomeValor = 'valor-' + {{$produto->id}};
                                                    var nomeValorCentavos = 'valor-centavos-' + {{$produto->id}};
                                                    produtoPreco= {{$produto->preco}};
                                                    prodPreco=produtoPreco.toFixed(2);
                                                    dividido=prodPreco.split('.');
                                                    $('#'+nomeValor).text(dividido[0]);
                                                    $('#'+nomeValorCentavos).text(dividido[1]);
                                            </script>
                                        @else
                                            <div class="todos-inline" aria-label="valor médio">
                                                R$ ≅
                                                <p id="valor-{{$produto->id}}" class="sem-margin">500</p>
                                                <sup class="centavos-produto" id="valor-centavos-{{$produto->id}}">40</sup>
                                            </div>
                                            <script>
                                                    var nomeValor = 'valor-' + {{$produto->id}};
                                                    var nomeValorCentavos = 'valor-centavos-' + {{$produto->id}};
                                                    produtoPreco= {{$produto->precoMedio}};
                                                    prodPreco=produtoPreco.toFixed(2);
                                                    dividido=prodPreco.split('.');
                                                    $('#'+nomeValor).text(dividido[0]);
                                                    $('#'+nomeValorCentavos).text(dividido[1]);
                                            </script>
                                        @endif
                                        <div class="paragrafo-produto">
                                            {{$produto->descricao_simplificada}}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <p class="d-none">{{$quantidadeProduto+=1}}</p>
                    @endif
                @endforeach
                @if ($quantidadeProduto==0)
                    <div class="col-md-12 sem-produtos">
                        Essa categoria ainda não possui produtos
                    </div>
                @endif

            </div>
        </div>
    </div>

</div>


@endsection