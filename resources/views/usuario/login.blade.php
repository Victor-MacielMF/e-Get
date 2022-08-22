@extends('layouts.main')

@section('title', 'Document')

@section('content')






<div class="container-fluid">
    {{-- Navegação do Site --}}
    <div id="navigation-area">
        <div class="container">
            <h1 id="navigation">
                <i class="bi bi-person-fill"></i> IDENTIFICAÇÃO
            </h1>
        </div>
    </div>
    {{-- Mensagem de erro --}}

    

    {{-- Login e Cadastro--}}
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


            <div class="row">
                {{-- Login --}}
                <div class="col-md-6 direita">
                    <div class="logcad">
                        <div class="row">
                            <h1 class="title">
                                Já tenho o cadastro
                            </h1>
                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <input id="email" type="email" class="form-control main-input espaco-embaixo" name="email" placeholder="E-mail*" alt="E-mail" required autocomplete="email" autofocus>
                                <input id="password" type="password" class="form-control main-input" name="password" placeholder="Senha*" required minlength="8" autocomplete="current-password">
                                <button type="submit" class="main-btn">
                                    <i class="bi bi-door-open-fill"></i>
                                    {{ __('Login') }}
                                </button>
                            </form>
                            {{--Recuperar Acesso --}}
                            <div class="row">
                                <div class="col-md-6 acesso">
                                        <a href="#" class="recuperar-acesso" id="login">Esqueci meu login</a>
                                </div>
                                <div class="col-md-6 acesso">
                                    <a href="#" class="recuperar-acesso" id="senha">Esqueci minha senha</a>
                                </div>
                            </div>
                            {{--Entrar com redes sociais--}}
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 id="title-2">Quero acessar com minhas redes sociais</h2>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn-facebook social" id="facebook"><i class="bi bi-facebook"></i>Entrar com o <span class="negrito">Facebook</span></button>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn-google social" id="google"><i class="bi bi-google"></i>Entrar com o <span class="negrito">Google</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- Cadastro --}}
                <div class="col-md-6 esquerda">
                    <div class="logcad">
                        <div class="row">
                            <h1 class="title">
                                Quero me cadastrar
                            </h1>
                        </div>
                        <form action="/registrar" method="POST">
                            @csrf
                            <input type="email" class="form-control main-input espaco-embaixo" name="email" placeholder="E-mail*" autocomplete="off" required>
                            <input type="password" class="form-control main-input espaco-embaixo" name="password" placeholder="Senha*" autocomplete="off" required minlength="8">
                            <input type="password" class="form-control main-input espaco-embaixo" name="password_confirmation" placeholder="Confirme a senha*" autocomplete="off" required minlength="8">
                            <input type="text" class="form-control main-input espaco-embaixo" id="strCPF" name="cpf" placeholder="CPF*" autocomplete="off" onkeypress="$(this).mask('000.000.000-00');" minlength="14" required>
                            <input type="text" class="form-control main-input" name="cep" placeholder="CEP*" autocomplete="off" onkeypress="$(this).mask('00.000-000')" minlength="10" required>
                            <div class="row">
                                <div class="col-md-12 cep-col">
                                    <a href="https://buscacepinter.correios.com.br/app/endereco/index.php"  target="_blank" class="cep-link" > Não sei meu CEP <i class="bi bi-question-circle-fill"></i></a>
                                </div>
                            </div>
                            <button type="submit" class="second-btn">
                                {{ __('Cadastrar') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection