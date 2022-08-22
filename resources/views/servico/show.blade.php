@extends('layouts.main')

@section('title', 'Document')

@section('content')
<div class="container-fluid">
    
    <div id="navigation-area">
        <div class="container sub-navigation">
            <a href="/">Home</a> > 
            <a href="/servicos">Servicos</a> > 
            <a href="servicos-{{$servico->categoria}}">
                @if ($servico->categoria==1)
                    Impressão 3D
                @else
                    Modelador 3D
                @endif</a> >
            <a href="">{{$servico->user->name}}</a>
        </div>
    </div>


    <div id="produto-view-area">
            <div class="container sem-padding">
                <div class="row">
                    <div class="col-md-5 azul">
                        <div id="carousel" class="carousel slide" data-ride="carousel" data-pause="hover" data-interval="false">
                            <div class="carousel-inner">
                                {{$indice=0}}
                                @foreach ($servico->imagens as $imagem)
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
                                @foreach ($servico->imagens as $imagem)
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
                            <div class="sem2">
                                <h1 class="titulo-servico">{{$servico->user->name}}</h1>
                                <p class="descricao">{{$servico->descricao}}</p>
                                @if ($servico->categoria==1)
                                @guest
                                    <div class="modal fade" id="orcamento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Orçamento</h5>
                                            </div>
                                            <form method="POST" action="/cadastrar-orcamento">
                                                @csrf
                                                <div class="modal-body relative-body">
                                                    <div class="col-md-12">
                                                        <label class="left-absolut">Mensagem:</label>
                                                        <textarea name="mensagem" class="form-control main-input" aria-label="With textarea" maxlength="1000" required></textarea>
                                                        <label class="left-absolut">Link do arquivo:</label>
                                                        <input type="text" class="d-none" value="{{$servico->id}}" name="servico" required>
                                                        <input type="text" class="form-control main-input" name="link" maxlength="60" placeholder="Link do Wetransfer, Google Drive, Dropbox, etc..." required>
                                                        <label class="left-absolut">Como quer que retornemos o seu contato?</label>
                                                        <div class="col-md-12">
                                                            <div class="radio-inline margin-right-aqui">
                                                                <INPUT TYPE="RADIO"  NAME="contato" VALUE="0" required> <p>Telefone</p>
                                                            </div>
                                                            <div class="radio-inline ">
                                                                <INPUT TYPE="RADIO"  NAME="contato" VALUE="1" required> <p>E-mail</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="second-btn modal-btn cancelar-modal" data-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="main-btn modal-btn">Cadastrar</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                @endguest
                                @auth
                                    @if ($servico->user->id!=auth()->user()->id)
                                        <div class="modal fade" id="orcamento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Orçamento</h5>
                                                </div>
                                                <form method="POST" action="/cadastrar-orcamento">
                                                    @csrf
                                                    <div class="modal-body relative-body">
                                                        <div class="col-md-12">
                                                            <label class="left-absolut">Mensagem:</label>
                                                            <textarea name="mensagem" class="form-control main-input" aria-label="With textarea" maxlength="1000" required></textarea>
                                                            <label class="left-absolut">Link do arquivo:</label>
                                                            <input type="text" class="d-none" value="{{$servico->id}}" name="servico" required>
                                                            <input type="text" class="form-control main-input" name="link" maxlength="60" placeholder="Link do Wetransfer, Google Drive, Dropbox, etc..." required>
                                                            <label class="left-absolut">Como quer que retornemos o seu contato?</label>
                                                            <div class="col-md-12">
                                                                <div class="radio-inline margin-right-aqui">
                                                                    <INPUT TYPE="RADIO"  NAME="contato" VALUE="0" required> <p>Telefone</p>
                                                                </div>
                                                                <div class="radio-inline ">
                                                                    <INPUT TYPE="RADIO"  NAME="contato" VALUE="1" required> <p>E-mail</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="second-btn modal-btn cancelar-modal" data-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="main-btn modal-btn">Enviar</button>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endauth
                                    <button type="submit"  data-toggle="modal" data-target="#orcamento"  class="orcamento-btn">Orçamento</button>
                                @else
                                    <div class="row forma-contatos">
                                        <div class="col-md-5"><i class="bi bi-telephone-fill forma-contato"></i><p class="inline3">{{$servico->user->telefone}}</p></div>
                                        <div class="col-md-7"><i class="bi bi-envelope-fill forma-contato"></i><p class="inline3">{{$servico->user->email}}</p></div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection