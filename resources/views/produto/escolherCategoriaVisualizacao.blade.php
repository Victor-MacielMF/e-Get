@extends('layouts.main')

@section('title', 'Document')

@section('content')
<div class="container-fluid vender">
        <div id="categoria-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="title-vender">
                            Qual categoria de <br>produtos deseja visualizar?
                        </h1>
                    </div>

                    <div class="col-md-6 vender-produto">
                        <a href="/produtos-1" class="sem-decoration">
                            <div class="area-produto">
                                <div class="categoria">
                                    <p>Robô</p>
                                </div>
                                <div class="imagem-categoria"></div>
                            </div>
                        </a>
                    </div>

                    
                    <div class="col-md-6 vender-servico">
                        <a href="/produtos-2" class="sem-decoration">
                            <div class="area-produto">
                                    <div class="categoria">
                                        <p>Impressão 3D</p>
                                    </div>
                                    <div class="imagem-categoria2">
                                    </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection