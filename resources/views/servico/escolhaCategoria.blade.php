@extends('layouts.main')

@section('title', 'Document')

@section('content')


<div class="container-fluid vender">
    <div class="container-fluid vender">
            <div id="categoria-area">
                <div class="container">
                    <div class="row" style='display:flex'>
                        <div class="col-md-12">
                            <h1 class="title-vender">
                                Qual tipo de serviço deseja oferecer?
                            </h1>
                        </div>
                        

                            <div class="col-md-6 vender-produto">
                                <form action="/vender-servico" style="margin: 0; padding: 0;display: inline;">
                                    <input type="text" name="categoria" value="1" class="d-none">
                                    <button class="button-div">
                                        <div class="area-robo">
                                            <div class="categoria">
                                                <p>Impressão 3D</p>
                                            </div>
                                            <div class="imagem-categoria3"></div>
                                        </div>
                                    </button>
                                </form>
                            </div>
    

                            <div class="col-md-6 vender-servico">
                                <form action="/vender-servico" style="margin: 0; padding: 0;display: inline;">
                                    <input type="text" name="categoria" value="2" class="d-none">
                                    <button class="button-div">
                                        <div class="area-impressao" id="area-impressao">
                                                <div class="categoria">
                                                    <p>Modelagem 3D</p>
                                                </div>
                                                <div class="imagem-categoria4">
                                                </div>
                                        </div>
                                    </button>
                                </form>
                            </div>
                        
                    </div>
                </div>
            </div>
    </div>
</div>