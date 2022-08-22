@extends('layouts.main')

@section('title', 'Document')

@section('content')
<div class="container-fluid vender">
        <div id="categoria-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="title-vender">
                            Qual categoria de <br>serviços deseja visualizar?
                        </h1>
                    </div>

                    <div class="col-md-6 vender-produto">
                        <a href="/servicos-1" class="sem-decoration">
                            <div class="area-produto">
                                <div class="categoria">
                                    <p>Impressão 3D</p>
                                </div>
                                <div class="imagem-categoria3"></div>
                            </div>
                        </a>
                    </div>

                    
                    <div class="col-md-6 vender-servico">
                        <a href="/servicos-2" class="sem-decoration">
                            <div class="area-produto">
                                    <div class="categoria">
                                        <p>Modelagem 3D</p>
                                    </div>
                                    <div class="imagem-categoria4">
                                    </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection