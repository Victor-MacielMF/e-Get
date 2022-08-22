@extends('layouts.main')

@section('title', 'Document')

@section('content')

    <div class="container-fluid">

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

                <div id="navigation-area">
                    <div class="container">
                        <h1 id="navigation">
                            <i class="bi bi-person-fill"></i> Clientes
                        </h1>
                    </div>
                </div>

                {{-- Pesquisa --}}
                <form action="/clientes" method="get">
                    <input type="text" class="form-control main-input espaco-embaixo espaco-cima" name="pesquisa"
                           placeholder="Pesquisa" value="" autocomplete="off">
                    <button hidden>Pesquisar</button>
                </form>

                <div class="col-md-12">
                    <div class="row">
                        {{-- Dados básicos --}}
                        <div class="col-md-12" id="leftbox">
                            <div class="logcad">
                                <div class="row">
                                    <div class="col-md-6">
                                    </div>
                                    <div class="col-md-6 align-right">
                                        <a type="button" class="second-btn" id="btn-novo-cliente"
                                           href="{{url('clientes/novo')}}">
                                            {{ __('Novo') }}
                                        </a>
                                    </div>
                                    @foreach($clientes as $c)
                                        <div class="container-fluid enderecos">
                                            <div class="enderecos-left">
                                                <p>
                                                    {{$c->nome}}
                                                    | {{$c->cpf}} {{$c->telefone? " | Telefone: $c->telefone" : ' | Número não informado'}}
                                                    <br>
                                                    {{$c->categoria? "$c->categoria" : 'Categoria não informada'}} <br>
                                                    {{$c->endereco->endereco? "{$c->endereco->endereco} ":'Endereço não informado'}},{{$c->endereco->numero? "{$c->endereco->numero}":' S/N'}} <br>
                                                    {{$c->endereco->bairro?"{$c->endereco->bairro}":'Bairro não informado'}}{{$c->endereco->complemento? ", {$c->endereco->complemento} " : ''}}<br>
                                                    {{$c->endereco->cep}} - {{$c->endereco->cidade}} - {{$c->endereco->estado}}
                                                </p><br>
                                            </div>
                                            <div class="enderecos-right">

                                                <form action="clientes/deletar-{{$c->id}}" method="post">
                                                    <a class="btn endereco-btn" href="/clientes/editar-{{$c->id}}">Editar</a>
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn endereco-btn">Excluir</button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-md-12 pagination">
                                    {{ $clientes->appends(['search'=> request()->get('search', '')])->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
