@extends('layouts.main')

@section('title', 'Document')

@section('content')
<div class="container-fluid vender">
        <div id="categoria-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="title-vender">
                            Antes de mais nada,<br>o que você deseja anunciar?
                        </h1>
                    </div>

                    <div class="col-md-6 vender-produto">
                        <a href="/vender-produto" class="sem-decoration">
                            <div class="area-produto">
                                <div class="categoria">
                                    <p>Produtos</p>
                                </div>
                                <div class="imagem-vender"></div>
                            </div>
                        </a>
                    </div>

                    
                    <div class="col-md-6 vender-servico">
                        <a href="/categoria-servico" class="sem-decoration">
                            <div class="area-produto">
                                    <div class="categoria">
                                        <p>Serviços</p>
                                    </div>
                                    <div class="imagem-vender2">
                                    </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection