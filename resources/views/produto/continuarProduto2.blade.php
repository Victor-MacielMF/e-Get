@extends('layouts.main')

@section('title', 'Document')

@section('content')
<div class="container-fluid vender">
    <form action="/finalizar-produto" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" class="d-none" name="id_produto" value="{{$produto->id}}">
        <div class="container" id="titulo">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="title-vender">
                        Preencha as informações do anúncio
                    </h1>
                </div>
            </div>
        </div>
        <div id="descricao-produto">
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
                                <button type="submit" class="main-btn modal-btn" value="avancar-1">Avançar</button>
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
                            <input name="descricao_simplificada" id="descricao-simplificada" type="text" class="main-input" maxlength="50" required>
                        </div>
                        <div class="col-md-12">
                            <div class="modal-footer containers-botoes">
                                <button type="button" class="second-btn modal-btn cancelar-modal" value="voltar-2">Voltar</button>
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
        if(nome=="avancar-1"){
            event.preventDefault();
            texto1=$("#descricao").val();
            if(!(texto1==null || texto1=="")){
                $('#descricao-produto').hide();
                $('#simplificada-produto').show();
            }
        }
        if(nome=="voltar-2"){
            event.preventDefault();
            $('#descricao-produto').show();
            $('#simplificada-produto').hide();
        }

    });
</script>
@endsection