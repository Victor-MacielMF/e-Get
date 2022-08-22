@extends('layouts.main')

@section('title', 'Document')

@section('content')
<form action="/storeCategoria" method="POST" enctype="multipart/form-data">
    @csrf
    <div id="titulo-area" >
        <div class="container">
            <div class="row titulo-area">
                <div class="col-md-12">
                    <h1 class="title-containers">
                        Adicione uma categoria
                    </h1>
                </div>
                <div class="col-md-12">
                    <input type="text" class="main-input" name="categoria" maxlength="60" required>
                </div>
                <div class="col-md-12">
                    <div class="modal-footer containers-botoes">
                        <button type="submit" class="main-btn modal-btn" >Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection