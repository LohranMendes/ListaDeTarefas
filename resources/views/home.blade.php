@extends('layout.master')
@section('title', 'Home')

@section('content')
        <div class="wrapper">
            <div class="d-flex justify-content-center align-items-center text-center">
                <div class="container-dois">
                    <div id="FotosTarefa" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#FotosTarefa" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Foto 3"></button>
                            <button type="button" data-bs-target="#FotosTarefa" data-bs-slide-to="1" aria-label="Foto 2"></button>
                            <button type="button" data-bs-target="#FotosTarefa" data-bs-slide-to="2" aria-label="Foto 3"></button>
                          </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="./img/960x0.jpg" class="d-block-img" alt="Uma lista de tarefas">
                                <div class="carousel-caption d-none d-md-block text-dark text-start py-2">
                                    <h5>Crie sua lista!</h5>
                                    <p class="fw-semibold">O site permite criar uma lista de tarefas de maneira fácil.</p>
                                </div>
                            </div>
                            <div class="carousel-item active">
                                <img src="./img/todolist_2.jpg" class="d-block-img" alt="Um fundo colorido, vermelho, rosa e azul, com uma agenda com a rotina embaixo de um carderno com as tarefas classificadas e uma agenda de lista de tarefas. Um celular em cima do carderno e alguns post its e lápis  espalhados.">
                                <div class="carousel-caption d-none d-md-block text-white text-start py-2">
                                    <h5>Organize suas tarefas!</h5>
                                    <p class="fw-semibold">Marqueas como terminadas e a lista como concluída no final.</p>
                                </div>
                            </div>
                            <div class="carousel-item active">
                                <img src="./img/todolist_3.jpg" class="d-block-img" alt="Um caderno em branco de lista de tarefas, com uma mão em cima e uma xícara de café ao lado, com o fundo de mesa de madeira.">
                                <div class="carousel-caption d-none d-md-block text-white text-start py-2">
                                    <h5>Aproveite seu tempo!</h5>
                                    <p class="fw-semibold">Pode-se adequar o tempo estimado para cada tarefa.</p>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#FotosTarefa" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Anterior</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#FotosTarefa" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Próximo</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="container px-4 py-5">
                <h2>Características</h2>
                <hr>
                    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
                        <div class="feature col">
                          <div class="d-inline-flex align-items-center justify-content-center text-bg-dark bg-gradient fs-2 mb-3 py-1">
                            <x-bi-check/>
                          </div>
                          <h3 class="fs-2 text-body-emphasis">Check!</h3>
                            <p>As tarefas adicionadas em sua lista poderão ter o status de concluída, que pode ser marcada a qualquer momento.</p>
                        </div>
                        <div class="feature col">
                            <div class="d-inline-flex align-items-center justify-content-center text-bg-dark bg-gradient fs-2 mb-3 py-1">
                            <x-bi-clipboard/>
                            </div>
                            <h3 class="fs-2 text-body-emphasis">Títulos</h3>
                            <p>Diferencie suas listas de tarefas com os títulos e melhore sua organização.</p>
                        </div>
                        <div class="feature col">
                            <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-dark bg-gradient fs-2 mb-3 p-1">
                            <x-bi-clock/>
                            </div>
                            <h3 class="fs-2 text-body-emphasis">Hora</h3>
                            <p>Defina uma estimativa de quantas horas será usada para uma tarefa.</p>
                        </div>
                        </div>
                    </div>
            </div>
        @if(Auth::check())
            <div class="container px-4">
                <div class="row">
                    <div class="col">
                        <div class="row g-0 border rounded shadow-sm mb-4">
                            <div class="col-md-6"> 
                                <img src="./img/todolist_4.jpg" class="d-block m-0" style="width: 100%;">
                            </div>
                            <div class="col-md-6 text-end">
                                <div class="mb-2" style="margin-top: 35%;">
                                    <span class="fw-bold fs-5 mr-2" style="display: block;">Tarefas!</span>
                                    <span class="mr-2" style="display: block;">Para novas tarefas, clique no botão.</span>
                                </div>
                                <a href="{{route("criaLista")}}" class="btn btn-dark mr-2">Criar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row g-0 border rounded shadow-sm mb-4">
                            <div class="col-md-6"> 
                                <img src="./img/todolist_5.jpg" class="d-block m-0" style="width: 100%;">
                            </div>
                            <div class="col-md-6 text-end">
                                <div class="mb-2" style="margin-top: 35%;">
                                    <span class="fw-bold fs-5 mr-2" style="display: block;">Minhas Tarefas!</span>
                                    <span class="mr-2" style="display: block;">Consulte suas tarefas pelo botão.</span>
                                </div>
                                <a href="{{route("mt")}}" class="btn btn-dark mr-2">Consultar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        </div>

@stop