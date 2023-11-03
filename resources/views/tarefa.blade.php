@extends('layout.master')
@section('title', 'Tarefa')

@section('content')

    @if(Auth::check())
        <div class="wrapper">
            <div class="d-flex justify-content-center mt-5">
                <h2 class="border-bottom w-50 text-center"> <?php echo ("{$lista->titulo} - {$dataFormat}")?></h2>
            </div>
            <div class="row", style="width: 100%;">
                <div class="col col-md-4 px-5 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title py-2">
                                <x-bi-caret-right-fill class="icons-tam d-inline-block"/> Painel de Escrita 
                            </h5>
                            <div class="text-end">
                                <br>
                                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#btnExcluir">Excluir</button>
                                <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#btnAlter">Alterar</button>
                                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#btnCriar">Criar</button>
                            </div>
                        </div>
                    </div>
                    <span class="text-dark px-2 text-decoration-underline">Obs: o número de tarefas é limitado a 10.</span>
                    @if(session('error'))
                        <div class="alert alert-danger col-md-9 w-100 mt-3">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
                <div class="col d-flex col-md-8 mt-3 mb-3 px-2">
                    <table class="table table-hover table-bordered" id="tabela">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col" style="width: 25%" class="text-center">Status</th>
                                <th scope="col" style="width: 25%" class="text-center">Nome</th>
                                <th scope="col" style="width: 25%" class="text-center">Tempo</th>
                                <th scope="col" style="width: 25%" class="text-center">Opções</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider text-center" id="tbody">
                            <?php $i = 0 ?>
                            @foreach($tarefas as $tarefa)
                            <tr style="height: 60px">
                                @if($tarefa->status == 0)
                                    <td>Em andamento</td>
                                @else
                                    <td>Concluído</td>
                                @endif
                                <td>{{ $tarefa->nome }}</td>
                                <td>{{ $tarefa->tempo }}</td>
                                <td class="d-flex justify-content-center">
                                    <button type="button" class="btn btn-dark mr-2" data-bs-toggle="modal" data-bs-target="#btnAltTaf{{$tarefa->id}}">Alterar</button>
                            
                                    <form method="POST" action="{{ route("tarefaEx", ["id" => $lista->id, "tarefa_id" => $tarefa->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{/{ $tarefas->id }}">
                                        <button type="submit" class="btn btn-dark">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                            <div class="modal fade" id="btnAltTaf{{$tarefa->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Alterando a tarefa</h5>
                                            <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Fechar">
                                                <x-bi-x class="icons-tam"/></span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route("tarefaAlter", ["id" => $lista->id, "tarefa_id" => $tarefa->id]) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3 col-md-9">
                                                    <label for="nome" class="form-label">Nome</label>
                                                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome da tarefa.">
                                                </div>
                                                <div class="mb-3 col-md-9">
                                                    <label for="tempo" class="form-label">Tempo (Em minutos)</label>
                                                    <input type="number" class="form-control" id="tempo" name="tempo" placeholder="Digite o tempo estimado para a tarefa" min="1">
                                                </div>
                                                <label for="status">Concluída:</label>
                                                <input type="checkbox" id="status" name="status" value="1">
                                                <br>
                                                <hr>
                                                <div class="d-flex justify-content-between">
                                                    <span class="fs-6 mt-2">*Obs: campos vazios não serão alterados.</span>
                                                    <input type="hidden" value={{$tarefa->id}}>
                                                    <button type="submit" class="btn btn-dark mr-2">Alterar Tarefa</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if(++$i > 9){break;}?>
                            @endforeach
                        </tbody>
                    </table>
                </div>         
            </div>
        </div>

        <div class="modal fade" id="btnCriar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Criando Tarefas</h5>
                        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Fechar">
                            <x-bi-x class="icons-tam"/></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route("tarefaPost", ["id" => $lista->id])}}" method="POST">
                            @csrf
                            <div class="mb-3 col-md-9">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome da tarefa.">
                            </div>
                            <div class="mb-3 col-md-9">
                                <label for="tempo" class="form-label">Tempo (Em minutos)</label>
                                <input type="number" class="form-control" id="tempo" name="tempo" placeholder="Digite o tempo estimado para a tarefa" min="1">
                            </div>
                            <div class="text-end">
                                <button type="Submit" class="btn btn-dark">Criar tarefa</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="btnAlter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Alterando a lista</h5>
                        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Fechar">
                            <x-bi-x class="icons-tam"/></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route("listaAlter", ["id" => $lista->id])}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3 col-md-9">
                                <label for="titulo" class="form-label">Titulo</label>
                                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Digite seu titulo.">
                            </div>
                            <div class="mb-3 col-md-9">
                                <label for="data" class="form-label">Data</label>
                                <input type="date" class="form-control" id="data" name="data">
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="fs-6 mt-2">*Obs: campos vazios não serão alterados.</span>
                                <button type="Submit" class="btn btn-dark">Alterar Lista</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="btnExcluir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Excluir a lista</h5>
                        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Fechar">
                            <x-bi-x class="icons-tam"/></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>
                            Você gostaria de excluir esta lista?
                        </p>
                        <form action="{{route("listaEx", ["id" => $lista->id])}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type=submit class="btn btn-dark">Excluir</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    @endif

@stop