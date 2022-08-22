@extends('layouts.main')

@section('title', 'Document')

@section('content')

<div class="container-fluid">





    {{-- Modal alterar senha --}}
    <div class="modal fade" id="alter-user-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Alterar senha</h5>
            </div>
            <form action="{{ route('change.password') }}" method="POST">
                @csrf

                <div class="modal-body">
                    <input type="password" class="form-control modal-input espaco-embaixo" name="current_password" placeholder="Digite a senha atual*" autocomplete="off" required minlength="8">
                    <input type="password" class="form-control modal-input espaco-embaixo" name="new_password" placeholder="Digite a nova senha*" autocomplete="off" required minlength="8">
                    <input type="password" class="form-control modal-input" name="new_confirm_password" placeholder="Confirme a nova senha*" autocomplete="off" required minlength="8">
                </div>
                <div class="modal-footer">
                    <button type="button" class="second-btn modal-btn cancelar-modal" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="main-btn modal-btn">Salvar</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    {{--Modal Editar Endereço--}}
    @foreach ($enderecos as $endereco)
        <div class="modal fade" id="alter-address-{{$endereco->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar endereço</h5>
                </div>
                <form action="/endereco/update/{{$endereco->id}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="text" class="form-control modal-input espaco-embaixo preenchimento-automatico" name="cep" value="{{$endereco->cep}}" autocomplete="off" readonly>
                        <input type="text" class="form-control modal-input espaco-embaixo" name="endereco" value="{{$endereco->endereco}}" placeholder="Endereço*" autocomplete="off" required>
                        <input type="text" class="form-control modal-input end-numero espaco-embaixo" name="numero" value="{{$endereco->numero}}" placeholder="Número*" autocomplete="off" required>
                        <input type="text" class="form-control modal-input end-comple" name="complemento" value="{{$endereco->complemento}}" placeholder="Complemento" autocomplete="off">
                        <input type="text" class="form-control modal-input espaco-embaixo" name="bairro" value="{{$endereco->bairro}}" placeholder="Bairro*" autocomplete="off" required>
                        <input type="text" class="form-control modal-input espaco-embaixo" name="referencia" value="{{$endereco->referencia}}" placeholder="Referencia" autocomplete="off">
                        <input type="text" class="form-control modal-input end-cidade preenchimento-automatico" name="cidade" value="{{$endereco->cidade}}" autocomplete="off" readonly>
                        <input type="text" class="form-control modal-input end-uf preenchimento-automatico" name="estado" value="{{$endereco->estado}}" autocomplete="off" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="second-btn modal-btn cancelar-modal" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="main-btn modal-btn">Salvar</button>
                    </div>
                </form>
                </div>
            </div>
        </div> 
    @endforeach

    {{--Modal Excluir Endereço--}}
    @foreach ($enderecos as $endereco)
    <div class="modal fade" id="delete-address-{{$endereco->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tem certeza que deseja excluir este endereço?</h5>
            </div>
            <form action="/endereco/{{$endereco->id}}" method="POST" enctype="multipart/form-data">
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

    {{--Modal Cadastrar Endereço--}}
    <div class="modal fade" id="Add-address" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar novo endereço</h5>
            </div>
            <form method="POST" action="/add/address">
                @csrf
                <div class="modal-body">

                    <input name="cep" class="form-control modal-input" type="text" id="cep" value="" onkeypress="$(this).mask('00.000-000')" minlength="10"
                    onblur="pesquisacep(this.value);" placeholder="Cep*" required/>
                    
                    <div class="col-md-12 cep-col">
                        <a href="https://buscacepinter.correios.com.br/app/endereco/index.php"  target="_blank" class="cep-link" > Não sei meu CEP <i class="bi bi-question-circle-fill"></i></a>
                    </div>
                               
                    
                    <input class="form-control modal-input espaco-embaixo" name="endereco" placeholder="Endereço*" type="text" id="rua" size="60" required/>

                    <input type="text" class="form-control modal-input end-numero espaco-embaixo" name="numero" placeholder="Número*" required/>

                    <input type="text" class="form-control modal-input end-comple" name="complemento" placeholder="Complemento"/>
                    
                    <input name="bairro" class="form-control modal-input espaco-embaixo" name="bairro" placeholder="Bairro*" type="text" id="bairro" size="40" required/>

                    <input type="text" class="form-control modal-input espaco-embaixo" name="referencia " placeholder="Referência"/>
                    <div id="div-label-cidade"><label for="cidade">Cidade:</label></div>
                    <div id="div-label-estado"><label for="uf">Estado:</label><br></div>
                    <input name="cidade" class="form-control modal-input end-cidade preenchimento-automatico" name="cidade" type="text" id="cidade" size="40" readonly required/>
                    <input class="form-control modal-input end-uf preenchimento-automatico" name="estado" type="text"  id="uf" size="2" readonly required/>
                    
                    <input name="ibge" type="hidden" id="ibge" size="8" disabled/>

                </div>
                <div class="modal-footer">
                    <button type="button" class="second-btn modal-btn cancelar-modal" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="main-btn modal-btn">Cadastrar</button>
                </div>
            </form>
            </div>
        </div>
    </div>


    <div id="navigation-area">
        <div class="container">
            <h1 id="navigation">
                <i class="bi bi-person-fill"></i> MEUS DADOS
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
                    {{-- Dados básicos --}}
                    <div class="col-md-6" id = "leftbox">
                        <div class="logcad left">
                            <div class="row">
                                <div class="col-md-6">
                                    <h1 class="title-view">
                                        Dados básicos
                                    </h1>
                                </div>
                                <div class="col-md-6 align-right">
                                    <button type="button" class="second-btn" id="btn-password" data-toggle="modal" data-target="#alter-user-password">
                                        {{ __('Alterar senha') }}
                                    </button>
                                </div>
                                <form action="/user/update/{{$user->id}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" class="form-control main-input espaco-embaixo espaco-cima" name="name" placeholder="Nome completo*" value="{{$user->name}}" autocomplete="off" minlength="3" required >
                                    <input type="email" class="form-control main-input espaco-embaixo preenchimento-automatico" name="email" value="{{$user->email}}" autocomplete="off" readonly required>
                                    <input type="text" class="form-control main-input espaco-embaixo preenchimento-automatico" name="cpf" value="{{$user->cpf}}" autocomplete="off" readonly required>
                                    <input type="text" class="form-control main-input espaco-embaixo" name="rg" value="{{$user->rg}}" placeholder="Rg*" alt="Rg" autocomplete="off" required>
                                    <div class="row row-sexo espaco-embaixo">
                                        <div class="col-md-12">
                                            <h1 class="title" id="sexo">Sexo</h1>
                                        </div>
                                        <div class="col-md-4">
                                            <INPUT TYPE="RADIO"  NAME="sexo" VALUE="I" {{ ($user->sexo=="I")? "checked" : "" }}> <p>Não informar</p>
                                        </div>
                                        <div class="col-md-4">
                                            <INPUT TYPE="RADIO"  NAME="sexo" VALUE="M" {{ ($user->sexo=="M")? "checked" : "" }}> <p>Masculino</p>
                                        </div>
                                        <div class="col-md-4 ">
                                            <INPUT TYPE="RADIO" NAME="sexo" VALUE="F" {{ ($user->sexo=="F")? "checked" : "" }}> <p>Feminino</p>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control main-input espaco-embaixo" id="nascimento" name="nascimento" value="{{ date('d/m/Y', strtotime($user->nascimento)) }}" placeholder="Data de Nascimento*" autocomplete="off" minlength="10" onkeypress="$(this).mask('00/00/0000')" required>
                                    <input type="text" class="form-control main-input" name="telefone" value="{{$user->telefone}}" onkeypress="$(this).mask('(00) 90000-0000')" placeholder="Telefone para contato" autocomplete="off">
                                    <div class="col-md-12 align-right">
                                        <button type="submit" class="main-btn" id="btn-salvar">
                                            {{ __('Salvar') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Endereços --}}
                    <div class="col-md-6" id = "rightbox">
                        <div class="logcad right relative">
                            <div class="row">
                                <h1 class="title" id="title-endereco">
                                    Endereços
                                </h1>
                                @foreach ($enderecos as $endereco)
                                    <div class="container-fluid enderecos">
                                        <div class="enderecos-left">
                                            <p class="rua">{{$endereco->endereco}}</p><br>
                                            <p class="numero">Número: {{$endereco->numero}}</p>
                                            @if (($endereco->complemento!=null) && ($endereco->complemento != ''))
                                                <p class="complemento">, {{$endereco->complemento}}</p>
                                            @endif
                                            @if (!empty($endereco->referencia))
                                            <br>
                                                <p class="referencia">{{$endereco->referencia}}</p>
                                            @endif
                                            <br>
                                            <p class="cep">{{$endereco->cep}} - </p>
                                            <p class="cidade">{{$endereco->cidade}}, </p>
                                            <p class="uf">{{$endereco->estado}}</p>
                                        </div>
                                        <div class="enderecos-right">
                                            <button class="btn endereco-btn" data-toggle="modal" data-target="#alter-address-{{$endereco->id}}">Editar</button>
                                            @if (count($enderecos)>1)
                                                <button class="btn endereco-btn" data-toggle="modal" data-target="#delete-address-{{$endereco->id}}">Excluir</button>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                        @if (count($enderecos)<2)
                            <div class="col-md-12 ">
                                <button type="submit" class="main-btn absolut" id="btn-salvar" data-toggle="modal" data-target="#Add-address">
                                    <i class="bi bi-plus-circle-fill"></i>
                                    {{ __('Novo Endereço') }}
                                </button>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection