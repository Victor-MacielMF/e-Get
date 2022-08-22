@extends('layouts.main')

@section('title', 'Document')

@section('content')
<div class="container-fluid">
    <div id="navigation-area">
        <div class="container">
            <h1 id="navigation">
                <i class="bi bi-person-fill"></i> Serviços
            </h1>
        </div>
    </div>
    
    <div id="logcad-area">
        <div class="container">
            {{-- Se tiver alguma mensagem de erro vai aparecer aqui --}}
            @if ($errors->any() || session('error'))
            <div class="alert alert-danger">
                {{session('error')}}
                @foreach ($errors->all() as $error)
                <div class="row">
                    {{ $error }}.
                </div>
                @endforeach

            </div>
            @endif
            @if (session('info'))
                <div class="alert alert-info">
                    {{session('info')}}
                </div>
            @endif
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6" id = "leftbox">
                        <div class="logcad left">
                            <div class="row">
                                <h1 class="title" id="title-endereco">
                                    Orçamentos solicitados
                                </h1>
                                @if ($orcamentosPedidos!=null)
                                    @foreach ($orcamentosPedidos->sortBy('concluido') as $pedido)
                                        <div class="modal fade" id="view-orcamento-{{$pedido->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Pedido de orçamento</h5>
                                                </div>
                                                    <div class="modal-body relative-body">
                                                        <div class="col-md-12">
                                                            <label class="left-absolut">Mensagem:</label>
                                                            <br>
                                                            <label class="left-absolut2">{{$pedido->mensagem}}</label>
                                                            <br>
                                                            <label class="left-absolut">Link do arquivo:</label>
                                                            <br>
                                                            <a href="{{$pedido->link}}"  target="_blank">{{$pedido->link}}</a>
                                                            <br>
                                                            <label class="left-absolut">Preferência de contato: </label>
                                                            <label class="left-absolut2">
                                                                @if ($pedido->pref_contato==0)
                                                                    Telefone
                                                                @else
                                                                    E-mail
                                                                @endif
                                                            </label>
                                                            <br>

                                                            </label>
                                                        </div>
                                                    </div>
                                                <div class="modal-footer">
                                                    <label class="left-absolut3">
                                                        @if ($pedido->concluido==1)
                                                                Orçamento realizado
                                                            @else
                                                                Orçamento pendente
                                                        @endif
                                                        </label>
                                                    <button type="button" class="second-btn modal-btn cancelar-modal" data-dismiss="modal">Fechar</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if ($pedido->concluido==0)
                                            <div class="container-fluid enderecos2">
                                                <div class="enderecos-left">
                                                    <p class="nome-orcamento">{{$pedido->servico->user->name}}</p><br>
                                                    <p class="numero">{{Str::limit($pedido->mensagem,120, $end='...')}}</p><br>
                                                </div>
                                                <div class="enderecos-right">
                                                    <button class="btn endereco-btn" data-toggle="modal" data-target="#view-orcamento-{{$pedido->id}}">Visualizar</button>
                                                </div>
                                            </div>
                                        @else
                                            <div class="container-fluid enderecos">
                                                <div class="enderecos-left">
                                                    <p class="nome-orcamento">{{$pedido->servico->user->name}}</p><br>
                                                    <p class="numero">{{Str::limit($pedido->mensagem,120, $end='...')}}</p><br>
                                                </div>
                                                <div class="enderecos-right">
                                                    <button class="btn endereco-btn" data-toggle="modal" data-target="#view-orcamento-{{$pedido->id}}">Visualizar</button>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    <div class="row">
                                        <div class="col-md-12 sem-orcamentos">
                                            <h4>Você ainda não solicitou um orçamento</h4>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" id = "rightbox">
                        <div class="logcad right relative">
                            <div class="row">
                                <h1 class="title" id="title-endereco">
                                    Meu anúncio
                                </h1>
                                @if ($servicos->isEmpty()) 
                                    <div class="row">
                                        <div class="col-md-12 sem-orcamentos">
                                            <h4>Você ainda não possui um anúncio</h4>
                                        </div>
                                    </div>
                                @else
                                    @if ($orcamentosSolicitados->isNotEmpty())
                                        @foreach ($orcamentosSolicitados->sortBy('concluido') as $pedido)
                                            <div class="modal fade" id="view-orcamento-{{$pedido->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Pedido de orçamento</h5>
                                                    </div>
                                                    <form action="/status-conluido" method="POST">
                                                        @csrf
                                                        <div class="modal-body relative-body">
                                                            <div class="col-md-12">
                                                                <label class="left-absolut">Mensagem:</label>
                                                                <br>
                                                                <label class="left-absolut2">{{$pedido->mensagem}}</label>
                                                                <br>
                                                                <label class="left-absolut">Link do arquivo:</label>
                                                                <a href="{{$pedido->link}}"  target="_blank">{{$pedido->link}}</a>
                                                                
                                                                <div class="row">
                                                                    <div class="col-md-4  sem-padding"><label class="left-absolut">Telefone: </label>
                                                                        <label class="left-absolut2">{{$pedido->user->telefone}}</label>
                                                                    </div>
                                                                    <div class="col-md-8 sem-padding"><label class="left-absolut">E-mail: </label>
                                                                        <label class="left-absolut2">{{$pedido->user->email}}</label>
                                                                    </div>
                                                                </div>
                                                                <label class="left-absolut">Preferência de contato: </label>
                                                                <label class="left-absolut2">
                                                                    @if ($pedido->pref_contato==0)
                                                                        Telefone
                                                                    @else
                                                                        E-mail
                                                                    @endif
                                                                </label>
                                                                </label>
                                                                
                                                            <div class="row row-sexo espaco-embaixo espaco-cima2">
                                                                <div class="col-md-12">
                                                                    <h1 class="title centralizado-meio" id="sexo">Status</h1>
                                                                </div>
                                                                <div class="col-md-6 centralizado-meio">
                                                                    <INPUT TYPE="RADIO"  NAME="concluido" VALUE="1"
                                                                    @if($pedido->concluido==1)
                                                                        checked
                                                                    @endif
                                                                    > <p>Concluído</p>
                                                                </div>
                                                                <div class="col-md-6 centralizado-meio">
                                                                    <INPUT TYPE="RADIO" NAME="concluido" VALUE="0"
                                                                    @if($pedido->concluido==0)
                                                                        checked
                                                                    @endif
                                                                    > <p>Pendente</p>
                                                                </div>
                                                                <input type="text" name="id_orcamento" class="d-none" value="{{$pedido->id}}" required>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    
                                                    <div class="modal-footer">
                                                        <button type="button" class="second-btn modal-btn cancelar-modal" data-dismiss="modal">Fechar</button>
                                                        <button type="submit" class="main-btn modal-btn">Salvar</button>
                                                    </div>
                                                </form>
                                                    </div>
                                                </div>
                                            </div>

                                            @if ($pedido->concluido==0)
                                                <div class="container-fluid enderecos2">
                                                    <div class="enderecos-left">
                                                        <p class="nome-orcamento">{{$pedido->user->name}}</p><br>
                                                        <p class="numero">{{Str::limit($pedido->mensagem,120, $end='...')}}</p><br>
                                                    </div>
                                                    <div class="enderecos-right">
                                                        <button class="btn endereco-btn" data-toggle="modal" data-target="#view-orcamento-{{$pedido->id}}">Visualizar</button>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="container-fluid enderecos">
                                                    <div class="enderecos-left">
                                                        <p class="nome-orcamento">{{$pedido->user->name}}</p><br>
                                                        <p class="numero">{{Str::limit($pedido->mensagem,120, $end='...')}}</p><br>
                                                    </div>
                                                    <div class="enderecos-right">
                                                        <button class="btn endereco-btn" data-toggle="modal" data-target="#view-orcamento-{{$pedido->id}}">Visualizar</button>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @else
                                        <div class="row">
                                            <div class="col-md-12 sem-orcamentos">
                                                <h4>Ainda não possui solicitações de orçamentos em seu anúncio</h4>
                                            </div>
                                        </div>
                                    @endif
                                @endif


                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
</div>


@endsection