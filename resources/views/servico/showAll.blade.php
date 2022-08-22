@extends('layouts.main')

@section('title', 'Document')

@section('content')



<div class="container-fluid">
    <div id="produtos-area">
        <div class="container sem-padding">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="title-vender">
                        @if ($categoria==1)
                            Impressão 3D sob encomenda
                        @else
                            Modeladores 3D
                        @endif
                    </h1>
                </div>
                <p class="d-none">{{$quantidadeServico=0}}</p>
                @foreach ($servicos as $servico)
                        <div class="col-md-2 sem-padding">
                            <a href="/servico-{{$servico->id}}" class="none">
                                <div class="card produtos-all">
                                    <h5 class="product-title2">{{$servico->user->name}}</h5>

                                    <p class="d-none">{{$indice=0}}</p>
                                    @foreach ($servico->imagens as $imagem)
                                        @if($indice==0)
                                            <div class="product-image" style="background-image: url({{$imagem->imagem}});"></div>
                                        @endif
                                        <p class="d-none">{{$indice+=1}}</p>
                                    @endforeach

                                    <div class="card-body">
                                        <div class="paragrafo-produto">
                                            {{$servico->descricao_simplificada}}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <p class="d-none">{{$quantidadeServico+=1}}</p>
                @endforeach
                @if ($quantidadeServico==0)
                    <div class="col-md-12 sem-produtos">
                        Essa categoria ainda não possui anunciantes
                    </div>
                @endif

            </div>
        </div>
    </div>

</div>


@endsection