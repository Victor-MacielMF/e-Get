@extends('layouts.main')

@section('title', 'Document')

@section('content')


<div class="container-fluid">
    
    <div id="navigation-area">
        <div class="container">
            <h1 id="navigation">
                <i class="bi bi-person-fill"></i> IDENTIFICAÇÃO
            </h1>
        </div>
    </div>
    {{-- Cadastro --}}
    <div id="logcad-area">
        <div class="container">

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="col-md-12">
                    <div class="row">
                           
                            
                            <div class="col-md-6" id = "leftbox">
                                <div class="logcad left">
                                    <div class="row">
                                        <h1 class="title">
                                            Dados pessoais
                                        </h1>
                                        <input type="text" class="form-control main-input espaco-embaixo" name="name" placeholder="Nome completo*" autocomplete="off" minlength="3" required>
                                        <input type="email" class="form-control main-input espaco-embaixo preenchimento-automatico" name="email" value="{{$array['email']}}" autocomplete="off" readonly required>
                                        <input type="text" class="form-control main-input espaco-embaixo preenchimento-automatico" name="cpf" value="{{$array['cpf']}}" autocomplete="off" readonly required>
                                        <input type="text" class="form-control main-input espaco-embaixo" name="rg" placeholder="Rg*" autocomplete="off" required>
                                        <div class="row row-sexo espaco-embaixo">
                                            <div class="col-md-12">
                                                <h1 class="title" id="sexo">Sexo</h1>
                                            </div>
                                            <div class="col-md-4">
                                                <INPUT TYPE="RADIO"  NAME="sexo" VALUE="I" checked> <p>Não informar</p>
                                            </div>
                                            <div class="col-md-4">
                                                <INPUT TYPE="RADIO"  NAME="sexo" VALUE="M"> <p>Masculino</p>
                                            </div>
                                            <div class="col-md-4 ">
                                                <INPUT TYPE="RADIO" NAME="sexo" VALUE="F"> <p>Feminino</p>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control main-input espaco-embaixo" id="nascimento" name="nascimento" placeholder="Data de Nascimento*" autocomplete="off" minlength="10" onkeypress="$(this).mask('00/00/0000')" required>
                                        <input type="text" class="form-control main-input" name="telefone" placeholder="Telefone para contato " onkeypress="$(this).mask('(00) 90000-0000')" autocomplete="off">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" id = "rightbox">
                                <div class="logcad right">
                                    <div class="row">
                                        <h1 class="title">
                                            Endereço de cadastro
                                        </h1>
                                        <input type="text" class="form-control main-input espaco-embaixo preenchimento-automatico" name="cep" value="{{$array['cep']}}" autocomplete="off" readonly>
                                        <input type="text" class="form-control main-input espaco-embaixo" name="endereco" placeholder="Endereço*" autocomplete="off" required>
                                        <input type="text" id="numero-cad" class="form-control main-input espaco-embaixo" name="numero" placeholder="Número*" autocomplete="off" required>
                                        <input type="text" id="complemento-cad" class="form-control main-input espaco-embaixo" name="complemento" placeholder="Complemento" autocomplete="off">
                                        <input type="text" class="form-control main-input espaco-embaixo" name="bairro" placeholder="Bairro*" autocomplete="off" required>
                                        <input type="text" class="form-control main-input espaco-embaixo" name="referencia" placeholder="Referência" autocomplete="off">
                                        <input type="text" id="cidade-cad" class="form-control main-input espaco-embaixo preenchimento-automatico" name="cidade" value="{{$array['cidade']}}" autocomplete="off" readonly>
                                        <input type="text" id="estado-cad" class="form-control main-input espaco-embaixo preenchimento-automatico" name="estado" value="{{$array['uf']}}" autocomplete="off" readonly>
                                        <p id="termos">Aqui vai ficar a parte de aceitar os termos de uso que ainda não foram desenvolvidos</p>
                                    </div>
                                </div>
                            </div>
        


                    </div>
                    
                    <div id="tela-anterior">
                        <input type="password" class="input-hidden" name="password" name="cpf" value="{{$array['password']}}" required readonly>
                        <input type="password" class="input-hidden" name="password_confirmation" name="cpf" value="{{$array['password_confirmation']}}" required readonly>
                    </div>

                    <div class="row" id="concluir">
                        <button type="submit" class="main-btn c" id="concluir">
                            <i class="bi bi-check-lg"></i>
                            {{ __('Concluir') }}
                        </button>
                    </div>
                </div>
            </form>


        </div>
    </div>
</div>
@endsection