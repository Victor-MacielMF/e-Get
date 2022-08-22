@extends('layouts.main')

@section('title', 'Document')

@section('content')


<div class="container-fluid vender">
    <form action="/produto-cadastrar" method="POST" enctype="multipart/form-data">
        @csrf
        <div id="categoria-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="title-vender">
                            Qual categoria seu produto pertence?
                        </h1>
                    </div>

                    <div class="col-md-6 vender-produto">
                        <button class="button-div">
                            <div class="area-robo">
                                <div class="categoria">
                                    <p>Robótica</p>
                                </div>
                                <div class="imagem-categoria"></div>
                            </div>
                        </button>
                    </div>

                    
                    <div class="col-md-6 vender-servico">
                        <button class="button-div">
                            <div class="area-impressao" id="area-impressao">
                                    <div class="categoria">
                                        <p>Impressão 3D</p>
                                    </div>
                                    <div class="imagem-categoria2">
                                    </div>
                            </div>
                        </button>
                    </div>
                    <div class="d-none">
                        <div class="col-md-6">
                            <INPUT TYPE="RADIO"  NAME="categoria" VALUE="1"  id="robo"> <p>Robô</p>
                        </div>
                        <div class="col-md-6">
                            <INPUT TYPE="RADIO"  NAME="categoria" VALUE="2" id="impressao"> <p>Impressão 3D</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container" id="titulo"  style="display: none;">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="title-vender">
                        Preencha as informações do anúncio
                    </h1>
                </div>
            </div>
        </div>
        
        <div id="titulo-area"  style="display: none;">
            <div class="container">
                <div class="row titulo-area">
                    <div class="col-md-12">
                        <h1 class="title-containers">
                            Preencha o título do seu anúncio
                        </h1>
                    </div>
                    <div class="col-md-12">
                        <p class="paragrafos-containers">Inclua somente o nome do produto:</p>
                    </div>
                    <div class="col-md-12">
                        <input type="text" class="main-input" id="titulo-produto" name="titulo" maxlength="60" required>
                    </div>
                    <div class="col-md-12">
                        <div class="modal-footer containers-botoes">
                            <button type="button" class="second-btn modal-btn cancelar-modal" value="voltar-1">Voltar</button>
                            <button type="submit" class="main-btn modal-btn" value="avancar-1">Avançar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="imagem-area" style="display: none;">
            <div class="container">
                <div class="row titulo-area">
                    <div class="col-md-12">
                        <div class="title-containers">
                            Insira as fotos do seu produto
                        </div>
                    </div>
                    <div class="col-md-12">
                        <p class="paragrafos-containers">Insira pelo menos 1 foto:</p>
                    </div>
                    <div class="col-md-12 col-file">
                        <input name="imagens[]" class="form-control" type="file" id="formFile" max="2" required multiple>
                    </div>
                    <div class="col-md-12">
                        <div class="modal-footer containers-botoes">
                            <button type="button" class="second-btn modal-btn cancelar-modal" value="voltar-2">Voltar</button>
                            <button type="submit" class="main-btn modal-btn" value="avancar-2">Avançar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="condicoes-venda" style="display: none;">
            <div class="container">
                <div class="row titulo-area">
                    <div class="col-md-12">
                        <h1 class="title-containers">
                            Condições de venda
                        </h1>
                    </div>
                    <div class="col-md-12">
                        <p class="paragrafos-containers">O seu produto possui componentes a serem especificados pelo cliente?</p>
                    </div>
                    <div class="radio-inline">
                        <INPUT TYPE="RADIO"  NAME="componentes" VALUE="S"> <p>Sim</p>
                    </div>
                    <div class="radio-inline">
                        <INPUT TYPE="RADIO"  NAME="componentes" VALUE="N"> <p>Não</p>
                    </div>
                    <div class="col-md-12">
                        <div class="modal-footer containers-botoes">
                            <button type="button" class="second-btn modal-btn cancelar-modal" value="voltar-3">Voltar</button>
                            <button type="submit" class="main-btn modal-btn" value="avancar-3">Avançar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="preco-produto" style="display: none;">
            <div class="container">
                <div class="row titulo-area">
                    <div class="col-md-12">
                        <h1 class="title-containers">
                            Condições de venda
                        </h1>
                    </div>
                    <div class="col-md-12">
                        <p class="paragrafos-containers">Qual é o preço unitário?</p>
                    </div>
                    <div class="col-md-12">
                        <input name="preco" type="text" class="main-input" id="preco-venda" maxlength="10" onkeypress="$(this).mask('###.##0,00', {reverse: true});">
                    </div>
                    <div class="col-md-12 espaco-em-cima">
                        <p class="paragrafos-containers">Unidades:</p>
                    </div>
                    <div class="col-md-12">
                        <input name="quantidade" type="number" class="main-input" id="qtd-venda" min="1" onkeypress="$(this).mask('000');" max="999">
                    </div>
                    <div class="col-md-12">
                        <div class="modal-footer containers-botoes">
                            <button type="button" class="second-btn modal-btn cancelar-modal" value="voltar-4">Voltar</button>
                            <button type="submit" class="main-btn modal-btn" value="avancar-4">Avançar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="descricao-produto" style="display: none;">
            <div id="preco-produto">
                <div class="container">
                    <div class="row titulo-area">
                        <div class="col-md-12">
                            <h1 class="title-containers">
                                Adicione uma descrição
                            </h1>
                        </div>
                        <div class="col-md-12">
                            <textarea name="descricao" class="form-control main-input" id="descricao" aria-label="With textarea" maxlength="500"></textarea>
                        </div>
                        <div class="col-md-12">
                            <div class="modal-footer containers-botoes">
                                <button type="button" class="second-btn modal-btn cancelar-modal" value="voltar-5">Voltar</button>
                                <button type="submit" class="main-btn modal-btn" value="avancar-5">Avançar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="simplificada-produto" style="display: none;">
                <div class="container">
                    <div class="row titulo-area">
                        <div class="col-md-12">
                            <h1 class="title-containers">
                                Adicione uma descrição simplificada
                            </h1>
                        </div>
                        <div class="col-md-12">
                            <p class="paragrafos-containers">Inclua o modelo e características principais.</p>
                        </div>
                        <div class="col-md-12">
                            <input name="descricao_simplificada" id="descricao-simplificada" type="text" class="main-input" maxlength="50">
                        </div>
                        <div class="col-md-12">
                            <div class="modal-footer containers-botoes">
                                <button type="button" class="second-btn modal-btn cancelar-modal" value="voltar-6">Voltar</button>
                                <button type="submit" class="main-btn modal-btn" value="concluir">Concluir</button>
                            </div>
                        </div>
                    </div>
            </div>
    </form>
</div>
<script>

    $( ".area-impressao" ).click(function() {
        event.preventDefault();
       $('#impressao').prop("checked", true);
       $("#titulo-area").show();
       $("#titulo").show();
       $("#categoria-area").hide();


    });
    $( ".area-robo" ).click(function() {
        event.preventDefault();
        $('#robo').prop("checked", true);
        $("#titulo-area").show();
        $("#titulo").show();
        $("#categoria-area").hide();
    });
    $(".modal-btn").click(function(){
        nome=$(this).val();
        var radioValue = $("input[name='componentes']:checked").val();

        if(nome=="voltar-1"){
            event.preventDefault();
            $("#titulo-area").hide();
            $("#titulo").hide();
            $("#categoria-area").show();

        }
        if(nome=="avancar-1"){
            event.preventDefault();
            texto1=$("#titulo-produto").val();
            if(!(texto1==null || texto1=="")){
                $("#imagem-area").show();
                $("#titulo-area").hide();
            }
        }
        if(nome=="voltar-2"){
            event.preventDefault();
            $("#imagem-area").hide();
            $("#titulo-area").show();
        }
        if(nome=="avancar-2"){
            event.preventDefault();
            texto1= document.getElementById("formFile").files.length;
            if(texto1>0){
                $("#condicoes-venda").show();
                $("#imagem-area").hide();
            }
        }
        if(nome=="voltar-3"){
            event.preventDefault();
            $("#condicoes-venda").hide();
            $("#imagem-area").show();
        }
        if(nome=="avancar-3"){
            if(radioValue=="N"){
                event.preventDefault();
                $("#preco-venda").prop('required',true);
                $("#qtd-venda").prop('required',true);
                $("#descricao").prop('required',true);
                $("#descricao-simplificada").prop('required',true);
                $("#preco-produto").show();
                $("#condicoes-venda").hide();
            }else if(radioValue=="S"){
                $("#preco-venda").prop('required',false);
                $("#qtd-venda").prop('required',false);
                $("#descricao").prop('required',false);
                $("#descricao-simplificada").prop('required',false);
            }else{
                event.preventDefault();
            }
        }
        if(nome=="voltar-4"){
            event.preventDefault();
            $("#preco-produto").hide();
            $("#condicoes-venda").show();
        }
        if(nome=="avancar-4"){
            event.preventDefault();
            texto1=$("#preco-venda").val();
            texto2=$("#qtd-venda").val();
            if(!(texto1==null || texto1=="" || texto2==null || texto2=="")){
                $("#descricao-produto").show();
                $("#preco-produto").hide();
            }
        }
        if(nome=="voltar-5"){
            event.preventDefault();
            $("#descricao-produto").hide();
            $("#preco-produto").show();
        }
        if(nome=="avancar-5"){
            event.preventDefault();
            texto1=$("#descricao").val();
            if(!(texto1==null || texto1=="")){
                $("#simplificada-produto").show();
                $("#descricao-produto").hide();
            }
        }
        if(nome=="voltar-6"){
            event.preventDefault();
            $("#simplificada-produto").hide();
            $("#descricao-produto").show();
        }
    });

</script>

@endsection