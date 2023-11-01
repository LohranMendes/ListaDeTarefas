@extends('layout.master')
@section('title', 'Registro')

@section('content')
    <div class="full-height-index d-flex">
        <div class="container mt-5">
            <div class="d-flex justify-content-center align-items-center">
                @if(session('error'))
                    <div class="alert alert-danger col-md-3">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
            <div class="d-flex" style="margin-left: 29%;">
                <div class="cor-site rounded-pill mr-2 px-1" style="display: inline-block;"></div>
                <h5 class="font-weight-bolder">Registro</span></h5>
            </div>
            <div class="card mx-auto col-md-5">
                <div class="card-body">
                    <form action="{{route("registroPost")}}" method="POST">
                        @csrf
                        <div class="mb-3 col-md-9">
                            <label for="usuario" class="form-label">Nome</label>
                            <input type="nome" class="form-control" id="usuario" name="usuario" placeholder="Digite seu nome">
                        </div>
                        <div class="mb-3 col-md-9">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu email.">
                        </div>
                        <div class="mb-3 col-md-9">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite sua senha.">
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-dark">Registro</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop