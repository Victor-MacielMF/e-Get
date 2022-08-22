@extends('layouts.main')

@section('title', 'Document')

@section('content')
<div class="container-fluid vender">
    <form action="/finalizar-produto" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container" id="titulo">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="title-vender">
                        Preencha as informações do anúncio
                    </h1>
                </div>
            </div>
        </div>
        <div id="preco-produto" >
            <div class="container">
                <div class="row titulo-area">
                    <div class="col-md-12">
                        <h1 class="title-containers">
                            Condições de venda
                        </h1>
                    </div>
                    <input type="text" class="d-none" name="id_produto" value="{{$produto->id}}">
                    <div class="col-md-12">
                        <p class="paragrafos-containers">Qual é o preço unitário?</p>
                    </div>
                    <div class="col-md-12">
                        <input name="preco" type="text" class="main-input" id="preco-venda" maxlength="10" onkeypress="$(this).mask('###.##0,00', {reverse: true});" required>
                    </div>
                    <div class="col-md-12 espaco-em-cima">
                        <p class="paragrafos-containers">Unidades:</p>
                    </div>
                    <div class="col-md-12">
                        <input name="quantidade" type="number" class="main-input" id="qtd-venda" min="1" onkeypress="$(this).mask('000');" max="999" maxlength="3" required>
                    </div>
                    <div class="col-md-12">
                        <div class="modal-footer containers-botoes">
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
                            <textarea name="descricao" class="form-control main-input" id="descricao" aria-label="With textarea" maxlength="500" required></textarea>
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

        <div id="simplificada-produto"  style="display: none;">
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
                            <input name="descricao_simplificada" id="descricao-simplificada" type="text" class="main-input" maxlength="50" required>
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
    $(".modal-btn").click(function(){
        nome=$(this).val();
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