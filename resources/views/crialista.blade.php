
@extends('layout.master')
@section('title', 'Criar Tarefas')

@section('content')
            <div class="full-height-index d-flex">
                <div class="container" style="margin-top: 10%;">
                    <div class="d-flex" style="margin-left: 29%;">
                        <div class="cor-site rounded-pill mr-2 px-1" style="display: inline-block;"></div>
                        <h5 class="font-weight-bolder">Crie uma lista</span></h5>
                    </div>
                    <div class="card mx-auto col-md-5">
                        <div class="card-body">
                            <form action="{{route('listaPost')}}" method="POST">
                                @csrf
                                <div class="mb-3 col-md-9">
                                    <label for="titulo" class="form-label">Título</label>
                                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Digite o título da sua lista.">
                                </div>
                                <div class="mb-3 col-md-9">
                                    <label for="data" class="form-label">Data</label>
                                    <input type="date" class="form-control" id="data" name="data">
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-dark">Criar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
@stop