@extends('layout.master')
@section('title', 'Minhas Tarefas')

@section('content')
    <div class="full-height-index">
        <div class="container-fluid">
            <div class="d-flex justify-content-center align-items-center">
                @if(session('error'))
                    <div class="alert alert-danger col-md-5 mt-3">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
            <div class="d-flex justify-content-center align-items-center">
                @if(session('sucess'))
                    <div class="alert alert-success col-md-5 mt-3">
                        {{ session('sucess') }}
                    </div>
                @endif
            </div>
            <div class="d-flex justify-content-between mt-3">
                <div class="d-flex px-2">
                    <div class="cor-site rounded-pill mr-2 px-1" style="display: inline-block;"></div>
                    <h5 class="font-weight-bolder">Minhas Listas</h5>
                </div>
                <div class="d-flex px-2">
                    <a href="{{route('criaLista')}}" class="btn btn-dark">Criar Lista</a>
                </div>
            </div>
            <div class="mt-2 px-2">
                <div class="row">
                    @foreach ($listas as $lista)
                    <div class="col col-md-3 mb-2">
                        <div class="card">
                            <a href={{route('tarefas', ['id' => $lista->id])}} class="text-dark text-decoration-none">
                                <div class="card-body bg-warning" style="height: 10rem;">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="card-title">
                                            <x-bi-caret-right-fill class="icons-tam d-inline-block"/> {{$lista->titulo}} 
                                        </h5>
                                        <h6> {{$lista->data}} </h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    

    
@stop