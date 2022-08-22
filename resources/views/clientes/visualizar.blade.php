@extends('layouts.main')

@section('title', 'Document')

@section('content')
    <div class="container-fluid ">
        <div class="container sem-padding">
            <div class="row">
                <div class="col-md-6 sem-padding">
                    <div id="navigation-area">
                        <h1 id="navigation">
                            <i class="bi bi-person-fill"></i> {{Request::is('*/editar-*')? "Editar" : 'Novo'}} cliente
                        </h1>
                    </div>
                </div>
                <div class="col-md-6 espaco-embaixo">
                    <a href="{{url('clientes')}}"
                       class="link-botao-2"
                       id="event-submit">Voltar
                    </a>
                    </form>
                </div>
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
                                {{ $error }}
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
                    <form action="/clientes/{{Request::is('*/editar-*')? "alterar-$cliente->id" : 'adicionar'}}"
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            {{-- Dados básicos --}}
                            <div class="col-md-6" id="leftbox">
                                <div class="logcad left">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h1 class="title-view2">
                                                Dados básicos
                                            </h1>
                                        </div>
                                        <input type="text" class="form-control main-input espaco-embaixo-2 espaco-cima"
                                               name="nome" placeholder="Nome completo*" value="{{$cliente->nome ?? ''}}"
                                               autocomplete="off" minlength="3" maxlength="128" required>
                                        <input type="text" class="form-control main-input espaco-embaixo-2 espaco-cima-2" id="strCPF"
                                               name="cpf" placeholder="CPF*" autocomplete="off"
                                               value="{{$cliente->cpf ?? ''}}"
                                               onkeypress="$(this).mask('000.000.000-00');" minlength="14" required>
                                        <input type="text" class="form-control main-input espaco-embaixo-2 espaco-cima-2"
                                               name="categoria" placeholder="Categoria" alt="categoria"
                                               value="{{$cliente->categoria ?? ''}}" autocomplete="off" maxlength="256">
                                        <input type="text" class="form-control main-input espaco-embaixo-2 espaco-cima-2" name="telefone"
                                               value="{{$cliente->telefone ?? ''}}"
                                               onkeypress="$(this).mask('(00) 0 0000-0000')"
                                               placeholder="Telefone para contato" autocomplete="off" minlength="16">
                                    </div>
                                </div>
                            </div>

                            {{-- Endereços --}}
                            <div class="col-md-6" id="rightbox">
                                <div class="logcad right relative">
                                    <div class="row">
                                        <h1 class="title" id="title-endereco">
                                            Endereço
                                        </h1>
                                    </div>
                                    <div class="modal-body">
                                        <input type="text" class="form-control main-input espaco-embaixo-2 espaco-cima"
                                               name="cep" id="cep" value="{{$cliente->endereco->cep ?? ''}}" autocomplete="off"
                                               onkeypress="$(this).mask('00.000-000')" minlength="10"
                                               onblur="pesquisacep(this.value);" placeholder="Cep*"
                                               required>
                                        <input class="form-control main-input espaco-embaixo-2 espaco-cima-2" name="endereco"
                                               value="{{$cliente->endereco->endereco ?? ''}}" placeholder="Endereço" type="text"
                                               id="rua"  maxlength="50"/>
                                        <input type="text" class="form-control modal-input end-numero" name="numero"
                                               value="{{$cliente->endereco->numero ?? ''}}" placeholder="Número" size="10" maxlength="10"/>
                                        <input type="text" class="form-control modal-input end-comple espaco-embaixo-2 espaco-cima-2"
                                               value="{{$cliente->endereco->complemento ?? ''}}" name="complemento"
                                               placeholder="Complemento"  maxlength="50"/>
                                        <input name="bairro" class="form-control main-input espaco-embaixo-2 espaco-cima-2"
                                               name="bairro" value="{{$cliente->endereco->bairro ?? ''}}" placeholder="Bairro"
                                               type="text" id="bairro" size="50"  maxlength="50"/>
                                        <input name="cidade"
                                               class="form-control modal-input end-cidade preenchimento-automatico"
                                               name="cidade" value="{{$cliente->endereco->cidade ?? ''}}" placeholder="Cidade*"
                                               type="text" id="cidade" size="40"  maxlength="50" readonly required/>
                                        <input class="form-control modal-input end-uf preenchimento-automatico espaco-embaixo-2 espaco-cima-2"
                                               name="estado" type="text" value="{{$cliente->endereco->estado ?? ''}}" id="uf"
                                               placeholder="Estado*" size="2"  maxlength="2" readonly required/>
                                        <input name="id" type="hidden" id="id" size="8" value="{{$cliente->id ?? ''}}"/>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row" id="concluir">
                            <button type="submit" class="main-btn c" id="concluir">
                                <i class="bi bi-check-lg"></i>
                                {{ __('Salvar') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    
    {!! JsValidator::formRequest('App\Http\Requests\ClienteRequest') !!}

@endsection
