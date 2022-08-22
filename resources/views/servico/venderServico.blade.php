@extends('layouts.main')

@section('title', 'Document')

@section('content')


<div class="container-fluid vender">
    <div class="container-fluid vender">
        <form action="/servico-cadastrar" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="d-none">
                <div class="col-md-6">
                    <INPUT TYPE="RADIO"  NAME="categoria" VALUE="1"  id="modelagem"
                    @if ($categoria==1)
                        checked
                    @endif
                    > <p>Robô</p>
                </div>
                <div class="col-md-6">
                    <INPUT TYPE="RADIO"  NAME="categoria" VALUE="2" id="impressao"
                    @if ($categoria==2)
                        checked
                    @endif
                    > <p>Impressão 3D</p>
                </div>
            </div>

            <div id="imagem-area" >
                <div class="container">
                    <div class="row titulo-area">
                        <div class="col-md-12">
                            <div class="title-containers">
                                Preencha as informações do seu serviço
                            </div>
                        </div>
                        <div class="col-md-12">
                            <p class="paragrafos-containers">Insira pelo menos uma foto (Ex : impressões realizadas por você, fotos de sua empresa):</p>
                        </div>
                        <div class="col-md-12 col-file">
                            <input name="imagens[]" class="form-control" type="file" id="formFile" max="2" required multiple>
                        </div>
                        <div class="col-md-12">
                            <div class="modal-footer containers-botoes">
                                <button type="submit" class="main-btn modal-btn" value="avancar-2">Avançar</button>
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
                                    <button type="button" class="second-btn modal-btn cancelar-modal" value="voltar-3">Voltar</button>
                                    <button type="submit" class="main-btn modal-btn" value="avancar-3">Avançar</button>
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
                                    <button type="button" class="second-btn modal-btn cancelar-modal" value="voltar-4">Voltar</button>
                                    <button type="submit" class="main-btn modal-btn" value="concluir">Concluir</button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </form>
    </div>
</div>
<script>
    $( ".area-impressao" ).click(function() {
        event.preventDefault();
       $('#impressao').prop("checked", true);
       $("#imagem-area").show();
       $("#titulo").show();
       $("#categoria-area").hide();


    });
    $( ".area-robo" ).click(function() {
        event.preventDefault();
        $('#modelagem').prop("checked", true);
        $("#imagem-area").show();
        $("#titulo").show();
        $("#categoria-area").hide();
    });

    $(".modal-btn").click(function(){
        nome=$(this).val();
        if(nome=="voltar-2"){
            event.preventDefault();
            $("#imagem-area").hide();
            $("#categoria-area").show();
        }
        if(nome=="avancar-2"){
            event.preventDefault();
            texto1= document.getElementById("formFile").files.length;
            if(texto1>0){
                $("#descricao-produto").show();
                $("#imagem-area").hide();
            }
        }
        if(nome=="voltar-3"){
            event.preventDefault();
            $("#descricao-produto").hide();
            $("#imagem-area").show();
        }
        if(nome=="avancar-3"){
            event.preventDefault();
            texto1=$("#descricao").val();
            if(!(texto1==null || texto1=="")){
                $("#simplificada-produto").show();
                $("#descricao-produto").hide();
            }
        }
        if(nome=="voltar-4"){
            event.preventDefault();
            $("#simplificada-produto").hide();
            $("#descricao-produto").show();
        }
    });
</script>
@endsection