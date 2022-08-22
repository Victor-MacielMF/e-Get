@extends('layouts.main')

@section('title', 'Document')

@section('content')




<div class="container-fluid vender">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1 class="title-vender">
                    Complete o cadastro do <br>
                    seu anúncio: {{$produto->nome}}
                </h1>
            </div>
            <div class="col-md-6">
                <form action="/finalizar-{{$produto->id}}" method="POST">
                    @csrf
                    <a href="/finalizar-{{$produto->id}}" 
                      class="link-botao" 
                      id="event-submit"
                      onclick="event.preventDefault();
                      this.closest('form').submit();">Cancelar
                    </a>
                  </form>
            </div>
        </div>
    </div>

    <form action="{{ route('storeCaracteristica') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if((count($produto->caracteristicas))==0)
            <div id="modais">
                <div class="modal fade" id="detalhe-opcao-0" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Você ainda não possui outras opções cadastradas neste produto</h5>
                        </div>            
                            <div class="modal-body">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="main-btn modal-btn" data-dismiss="modal">Ok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div id="modais">
                <div class="modal fade" id="detalhe-opcao-0" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Selecione as opções que são incompatíveis</h5>
                        </div>            
                            <div class="modal-body">
                                @foreach ($produto->caracteristicas as $caracteristica)
                                    <div class="multiselect">
                                        <div class="selectBox">
                                        <select>
                                            <option>{{$caracteristica->caracteristica->nome}}</option>
                                        </select>
                                        <div class="overSelect"></div>
                                        </div>
                                        <div id="checkboxes">
                                            @foreach ($caracteristica->opcoes_real as $opcao)
                                                <label>
                                                    <input type="checkbox" id="one" name="compatibilidade[]" value="0.{{$opcao->pivot['id']}}"/>{{$opcao->nome}}
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="main-btn modal-btn" data-dismiss="modal">Salvar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        
        <div id="componente-area">
            <div class="container">
                <div class="row titulo-area">
                    <div class="col-md-12">
                        <h1 class="title-containers">
                            Criação de componentes a ser especificado pelo comprador
                        </h1>
                    </div>
                    <div class="col-md-12">
                        <p class="paragrafos-containers">Adicione o nome desse componente (Ex: Cor , Bateria, Carcaça):</p>
                    </div>
                    <div class="col-md-12">
                        <input type="text" class="main-input" name="nome_caracteristica" id="nome" maxlength="30" autocomplete="off" required>
                    </div>
                    <div class="col-md-12">
                        <div class="modal-footer containers-botoes">
                            <button type="submit" class="main-btn modal-btn" value="avancar-1">Avançar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="opcoes-area" style="display: none;">
            <div class="container">
                <div class="row titulo-area">
                    <div class="col-md-12">
                        <h1 class="title-containers">
                            Criação de componentes a ser especificado pelo comprador
                        </h1>
                    </div>
                    <div class="row">
                        <div class="col-md-7 padding-direita">
                            <p class="paragrafos-containers">Adicione as opções de escolha:</p>
                        </div>
                        <div class="col-md-2 padding-direita">
                            <p class="paragrafos-containers">Preço unitário:</p>
                        </div>
                        <div class="col-md-2 padding-direita">
                            <p class="paragrafos-containers">Quantidade:</p>
                        </div>
                        <div class="col-md-1 sem-padding text-align">
                            <p class="paragrafos-containers">Opcional</p>
                        </div>
                    </div>
                    <div class="row" id="opcoes">
                        <div class="row" id="opcao-1">
                            <div class="col-md-7 padding-direita">
                                <input type="text" class="main-input" name="opcao[]" maxlength="30"  autocomplete="off" required>
                            </div>
                            <div class="col-md-2 padding-direita">
                                <input type="text" class="main-input" name="preco[]" id="preco" maxlength="10" onkeypress="$(this).mask('###.##0,00', {reverse: true});" autocomplete="off" required>
                            </div>
                            <div class="col-md-2 padding-direita">
                                <input type="number" class="main-input" id="qtd-input" name="qtd[]" onkeypress="$(this).mask('000');" max="999" maxlength="3" autocomplete="off" required>
                            </div>
                            <div class="col-md-1 sem-padding">
                                <button type="button" class="second-btn modal-btn detalhes" data-toggle="modal" data-target="#detalhe-opcao-0">Detalhes</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button class="second-btn mais-opcao"  value="menos"><i class="bi bi-dash"></i></button>
                        <button class="main-btn mais-opcao"  value="mais"><i class="bi bi-plus-lg"></i></button>
                    </div>
                    <div class="col-md-12">
                        <div class="modal-footer containers-botoes opcoes-footer">
                            <button type="button" class="second-btn modal-btn cancelar-modal" value="voltar-2">Voltar</button>
                            <button type="submit" class="main-btn modal-btn" value="concluir">Concluir</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <input type="text" class="d-none" value="{{$produto->id}}" name="produto_id">
    </form>
</div>
           {{-- 
                        
<div class="col-md-7 padding-direita"><input type="text" class="main-input" name="opcao[]" maxlength="30"  autocomplete="off" required></div><div class="col-md-2 padding-direita"><input type="text" class="main-input" name="preco[]" maxlength="10" onkeypress="$(this).mask('###.##0,00', {reverse: true});" autocomplete="off" required></div><div class="col-md-2 padding-direita"><input type="number" class="main-input" id="qtd-input" name="qtd[]" maxlength="30" autocomplete="off" required></div><div class="col-md-1 sem-padding"><button class="second-btn detalhes">Detalhes</button></div></div>


<div class="row" id="opcao-0"><div class="col-md-8 padding-direita"><input type="text" class="main-input" name="titulo" maxlength="30" autocomplete="off" required></div><div class="col-md-3 padding-direita"><input type="text" class="main-input" name="titulo" maxlength="30" autocomplete="off" required></div><div class="col-md-1 sem-padding"><button class="second-btn detalhes">Detalhes</button></div></div>
            
var semModal = $('<div id="modais"> <div class="modal fade" '+idModal+' tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> <div class="modal-dialog modal-lg modal-dialog-centered" role="document"> <div class="modal-content"><div class="modal-header"><h5 class="modal-title">Você ainda não possui outras opções cadastradas neste produto</h5></div><div class="modal-body"></div><div class="modal-footer"><button type="submit" class="main-btn modal-btn" data-dismiss="modal">Ok</button></div></div></div></div></div><script>');
var modal = $('<div class="modal fade" '+idModal+' tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog modal-lg modal-dialog-centered" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">Selecione as opções que são incompatíveis</h5></div>            <div class="modal-body">@foreach ($produto->caracteristicas as $caracteristica)<div class="multiselect"><div class="selectBox"><select><option>{{$caracteristica->caracteristica->nome}}</option></select><div class="overSelect"></div></div><div id="checkboxes">@foreach ($caracteristica->opcoes_real as $opcao)<label><input type="checkbox" id="one" name="compatibilidade[]" value="'+componenteAtual+'.{{$opcao->pivot['id']}}"/>{{$opcao->nome}}</label>@endforeach</div></div>@endforeach</div><div class="modal-footer"><button type="submit" class="main-btn modal-btn" data-dismiss="modal">Salvar</button></div></div></div></div>');


<div class="modal fade" id="detalhe-opcao-0" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog modal-lg modal-dialog-centered" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">Compatibilidade</h5></div>            <div class="modal-body">@foreach ($produto->caracteristicas as $caracteristica)<div class="multiselect"><div class="selectBox"><select><option>{{$caracteristica->caracteristica->nome}}</option></select><div class="overSelect"></div></div><div id="checkboxes">@foreach ($caracteristica->opcoes_real as $opcao)<label><input type="checkbox" id="one" name="compatibilidade[]" value="0.{{$opcao->pivot['id']}}"/>{{$opcao->nome}}</label>@endforeach</div></div>@endforeach</div><div class="modal-footer"><button type="submit" class="main-btn modal-btn" data-dismiss="modal">Salvar</button></div></div></div></div>
--}}

<script>


    var componenteInicial = 1;
    $(".modal-btn").click(function(){
        nome=$(this).val();
        if(nome=="avancar-1"){
            event.preventDefault();
            texto1=$("#nome").val();
            if(!(texto1==null || texto1=="")){
                $('#componente-area').hide();
                $('#opcoes-area').show();
            }
        }
        if(nome=="voltar-2"){
            event.preventDefault();
            $('#componente-area').show();
            $('#opcoes-area').hide();
        }

    });

    $(".mais-opcao").click(function(){
        
        nome=this.value;
        if(nome=="mais"){
            componenteInicial += 1;
            componenteAtual = componenteInicial-1;
            var idModal= 'id="detalhe-opcao-'+componenteAtual+'"';
            var mascara = "'###.##0,00'"
            var mascara2 = "'000'"
            var keyPress2 = 'onkeypress="$(this).mask('+mascara2+');"'
            var keyPress= 'onkeypress="$(this).mask('+mascara+', {reverse: true});"'
            var opcaoId = '<div class="row espacado" id="opcao-' + componenteInicial + '">';
            var input = $(opcaoId+'<div class="col-md-7 padding-direita"><input type="text" class="main-input" name="opcao[]" maxlength="30"  autocomplete="off" required></div><div class="col-md-2 padding-direita"><input type="text" class="main-input" name="preco[]" maxlength="10" autocomplete="off" '+keyPress+'  required></div><div class="col-md-2 padding-direita"><input type="number" class="main-input" id="qtd-input" name="qtd[]" max="999" '+keyPress2+' maxlength="3" autocomplete="off" required></div><div class="col-md-1 sem-padding"><button type="button" class="second-btn modal-btn detalhes" data-toggle="modal" data-target="#detalhe-opcao-'+componenteAtual+'">Detalhes</button></div></div>');
            $("#opcoes").append(input);
            var semModal = $('<div id="modais"> <div class="modal fade" '+idModal+' tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> <div class="modal-dialog modal-lg modal-dialog-centered" role="document"> <div class="modal-content"><div class="modal-header"><h5 class="modal-title">Você ainda não possui outras opções cadastradas neste produto</h5></div><div class="modal-body"></div><div class="modal-footer"><button type="submit" class="main-btn modal-btn" data-dismiss="modal">Ok</button></div></div></div></div></div><script>');
            var modal = $('<div class="modal fade" '+idModal+' tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog modal-lg modal-dialog-centered" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">Selecione as opções que são incompatíveis</h5></div>            <div class="modal-body">@foreach ($produto->caracteristicas as $caracteristica)<div class="multiselect"><div class="selectBox"><select><option>{{$caracteristica->caracteristica->nome}}</option></select><div class="overSelect"></div></div><div id="checkboxes">@foreach ($caracteristica->opcoes_real as $opcao)<label><input type="checkbox" id="one" name="compatibilidade[]" value="'+componenteAtual+'.{{$opcao->pivot['id']}}"/>{{$opcao->nome}}</label>@endforeach</div></div>@endforeach</div><div class="modal-footer"><button type="submit" class="main-btn modal-btn" data-dismiss="modal">Salvar</button></div></div></div></div>'); 
            @if ((count($produto->caracteristicas))>0)
                $("#modais").append(modal);
            @else
                $("#modais").append(semModal);
            @endif
        }
        if(nome=="menos"){
            if(componenteInicial>1){
                var opcaoId = 'opcao-' + componenteInicial;
                $("#"+opcaoId).remove();
                componenteInicial-=1;
            }
        }
        event.preventDefault();
    });
</script>

@endsection